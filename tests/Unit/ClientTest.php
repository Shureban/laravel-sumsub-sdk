<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Shureban\LaravelSumsubSdk\Attributes\Level;
use Shureban\LaravelSumsubSdk\Attributes\Signature;
use Shureban\LaravelSumsubSdk\Client;
use Shureban\LaravelSumsubSdk\Dto\Requests\ChangingTopLevelInfoRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateAccessTokenRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateApplicantRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\GetApplicantDataRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\ResetApplicantRequest;
use Shureban\LaravelSumsubSdk\Enums\ApplicantType;
use Shureban\LaravelSumsubSdk\Tests\TestCase;

class ClientTest extends TestCase
{
    private Client      $client;
    private MockHandler $mock;
    /** @var array<int, array{request: RequestInterface}> */
    private array $history = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->mock  = new MockHandler();
        $stack       = HandlerStack::create($this->mock);
        $stack->push(Middleware::history($this->history));

        $this->client = new Client(self::API_KEY, self::SECRET_KEY);
        $this->setPrivateProperty($this->client, 'client', new GuzzleClient([
            'base_uri' => config('sumsub.domain'),
            'handler'  => $stack,
        ]));
    }

    public function testCreateAccessToken(): void
    {
        $this->mock->append(new Response(200, [], $this->fixture('access_token.json')));

        $body = $this->client->createAccessToken(new CreateAccessTokenRequest(new Level('basic-kyc-level'), 'user-42'));

        $request = $this->lastRequest();
        $this->assertSame($this->fixture('access_token.json'), $body);
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('https://api.sumsub.com/resources/accessTokens?ttlInSecs=600&userId=user-42&levelName=basic-kyc-level', (string)$request->getUri());
        $this->assertSame('', (string)$request->getBody());
        $this->assertSignedRequest($request, '/resources/accessTokens?ttlInSecs=600&userId=user-42&levelName=basic-kyc-level');
    }

    public function testCreateApplicant(): void
    {
        $this->mock->append(new Response(201, [], $this->fixture('applicant_individual.json')));

        $body = $this->client->createApplicant(new CreateApplicantRequest(new Level('basic-kyc-level'), 'user-42'));

        $request = $this->lastRequest();
        $this->assertSame($this->fixture('applicant_individual.json'), $body);
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('https://api.sumsub.com/resources/applicants?levelName=basic-kyc-level', (string)$request->getUri());
        $this->assertSame('{"externalUserId":"user-42"}', (string)$request->getBody());
        $this->assertSignedRequest($request, '/resources/applicants?levelName=basic-kyc-level', '{"externalUserId":"user-42"}');
    }

    public function testGetApplicantDataByExternalUserId(): void
    {
        $this->mock->append(new Response(200, [], '{}'));

        $this->client->getApplicantData(new GetApplicantDataRequest('user-42'));

        $request = $this->lastRequest();
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('https://api.sumsub.com/resources/applicants/-;externalUserId=user-42/one', (string)$request->getUri());
        $this->assertSame('', (string)$request->getBody());
        $this->assertSignedRequest($request, '/resources/applicants/-;externalUserId=user-42/one');
    }

    public function testGetApplicantDataPrefersApplicantId(): void
    {
        $this->mock->append(new Response(200, [], '{}'));

        $this->client->getApplicantData(new GetApplicantDataRequest('user-42', 'abc123'));

        $request = $this->lastRequest();
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('https://api.sumsub.com/resources/applicants/abc123/one', (string)$request->getUri());
        $this->assertSignedRequest($request, '/resources/applicants/abc123/one');
    }

    public function testChangingTopLevelInfo(): void
    {
        $this->mock->append(new Response(200, [], '{}'));

        $payload        = new ChangingTopLevelInfoRequest('abc123');
        $payload->email = 'john@example.com';
        $payload->type  = ApplicantType::Individual;

        $this->client->changingTopLevelInfo($payload);

        $request = $this->lastRequest();
        $body    = json_decode((string)$request->getBody(), true);

        $this->assertSame('PATCH', $request->getMethod());
        $this->assertSame('https://api.sumsub.com/resources/applicants', (string)$request->getUri());
        $this->assertSame('abc123', $body['id']);
        $this->assertSame('john@example.com', $body['email']);
        $this->assertSame('individual', $body['type']);
        $this->assertArrayHasKey('deleted', $body);
        $this->assertNull($body['deleted']);
        $this->assertSignedRequest($request, '/resources/applicants', (string)$request->getBody());
    }

    public function testResetApplicant(): void
    {
        $this->mock->append(new Response(200, [], $this->fixture('ok.json')));

        $body = $this->client->resetApplicant(new ResetApplicantRequest('abc123'));

        $request = $this->lastRequest();
        $this->assertSame($this->fixture('ok.json'), $body);
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('https://api.sumsub.com/resources/applicants/abc123/reset', (string)$request->getUri());
        $this->assertSame('', (string)$request->getBody());
        $this->assertSignedRequest($request, '/resources/applicants/abc123/reset');
    }

    public function testHttpErrorsPropagateAsGuzzleExceptions(): void
    {
        $this->mock->append(new Response(404, [], '{"description":"Applicant not found","code":404}'));

        $this->expectException(ClientException::class);
        $this->expectExceptionCode(404);

        $this->client->getApplicantData(new GetApplicantDataRequest('user-42'));
    }

    /**
     * @return RequestInterface
     */
    private function lastRequest(): RequestInterface
    {
        $this->assertCount(1, $this->history);

        return $this->history[0]['request'];
    }

    /**
     * @param RequestInterface $request
     * @param string           $signedUrl
     * @param string           $body
     *
     * @return void
     */
    private function assertSignedRequest(RequestInterface $request, string $signedUrl, string $body = ''): void
    {
        $this->assertSame('application/json', $request->getHeaderLine('Content-Type'));
        $this->assertSame(self::API_KEY, $request->getHeaderLine('X-App-Token'));

        $time = $request->getHeaderLine('X-App-Access-Ts');
        $this->assertMatchesRegularExpression('/^\d{10}$/', $time);
        $this->assertEqualsWithDelta(time(), (int)$time, 5);

        $expected = (string)new Signature(self::SECRET_KEY, $signedUrl, (int)$time, $request->getMethod(), $body);
        $this->assertSame($expected, $request->getHeaderLine('X-App-Access-Sig'));
    }
}
