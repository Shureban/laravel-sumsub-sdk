<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use Shureban\LaravelObjectMapper\Exceptions\ParseJsonException;
use Shureban\LaravelSumsubSdk\Attributes\Level;
use Shureban\LaravelSumsubSdk\Client;
use Shureban\LaravelSumsubSdk\Dto\Requests\ChangingTopLevelInfoRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateAccessTokenRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateApplicantRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\GetApplicantDataRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\ResetApplicantRequest;
use Shureban\LaravelSumsubSdk\Dto\Responses\AccessToken;
use Shureban\LaravelSumsubSdk\Dto\Responses\ApplicantData;
use Shureban\LaravelSumsubSdk\Dto\Responses\OkResponse;
use Shureban\LaravelSumsubSdk\Enums\ApplicantType;
use Shureban\LaravelSumsubSdk\Enums\ReviewStatus;
use Shureban\LaravelSumsubSdk\Exceptions\ApplicantNotFoundException;
use Shureban\LaravelSumsubSdk\SumsubApi;
use Shureban\LaravelSumsubSdk\Tests\TestCase;

class SumsubApiTest extends TestCase
{
    private SumsubApi $api;
    private Client&MockObject $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = $this->createMock(Client::class);
        $this->api    = new SumsubApi(self::API_KEY, self::SECRET_KEY);

        $this->setPrivateProperty($this->api, 'client', $this->client);
    }

    public function testCreateAccessToken(): void
    {
        $request = new CreateAccessTokenRequest(new Level('basic-kyc-level'), 'user-42');
        $this->client->expects($this->once())->method('createAccessToken')->with($request)->willReturn($this->fixture('access_token.json'));

        $token = $this->api->createAccessToken($request);

        $this->assertInstanceOf(AccessToken::class, $token);
        $this->assertSame('_act-sbx-a1b2c3d4-e5f6-7890-abcd-ef1234567890', $token->token);
        $this->assertSame('user-42', $token->userId);
    }

    public function testCreateApplicant(): void
    {
        $request = new CreateApplicantRequest(new Level('basic-kyc-level'), 'user-42');
        $this->client->expects($this->once())->method('createApplicant')->with($request)->willReturn($this->fixture('applicant_individual.json'));

        $applicant = $this->api->createApplicant($request);

        $this->assertInstanceOf(ApplicantData::class, $applicant);
        $this->assertSame('5f0b6f2b1b7b3f0001a1b2c3', $applicant->id);
        $this->assertSame('user-42', $applicant->externalUserId);
        $this->assertSame(ApplicantType::Individual, $applicant->type);
        $this->assertSame(ReviewStatus::Completed, $applicant->review->reviewStatus);
    }

    public function testGetApplicantData(): void
    {
        $request = new GetApplicantDataRequest('company-7');
        $this->client->expects($this->once())->method('getApplicantData')->with($request)->willReturn($this->fixture('applicant_company.json'));

        $applicant = $this->api->getApplicantData($request);

        $this->assertSame('6a1b2c3d4e5f60718293a4b5', $applicant->id);
        $this->assertSame(ApplicantType::Company, $applicant->type);
        $this->assertSame('ACME LTD', $applicant->fixedInfo->companyInfo->companyName);
    }

    public function testGetApplicantDataNotFound(): void
    {
        $request  = new GetApplicantDataRequest('user-42', 'abc123');
        $previous = new ClientException('Not Found', new Request('GET', '/x'), new Response(404));
        $this->client->expects($this->once())->method('getApplicantData')->willThrowException($previous);

        try {
            $this->api->getApplicantData($request);
            $this->fail('ApplicantNotFoundException was not thrown');
        } catch (ApplicantNotFoundException $exception) {
            $this->assertSame(404, $exception->getCode());
            $this->assertSame('Applicant not found. ApplicantId: abc123. ExternalUserId: user-42', $exception->getMessage());
        }
    }

    public function testGetApplicantDataRethrowsOtherHttpErrors(): void
    {
        $error = new ServerException('Server Error', new Request('GET', '/x'), new Response(500));
        $this->client->expects($this->once())->method('getApplicantData')->willThrowException($error);

        try {
            $this->api->getApplicantData(new GetApplicantDataRequest('user-42'));
            $this->fail('ServerException was not thrown');
        } catch (ServerException $exception) {
            $this->assertSame($error, $exception);
            $this->assertSame(500, $exception->getCode());
        }
    }

    public function testGetApplicantDataRethrowsConnectErrors(): void
    {
        $error = new ConnectException('Connection refused', new Request('GET', '/x'));
        $this->client->expects($this->once())->method('getApplicantData')->willThrowException($error);

        $this->expectException(ConnectException::class);

        $this->api->getApplicantData(new GetApplicantDataRequest('user-42'));
    }

    public function testChangingTopLevelInfo(): void
    {
        $request = new ChangingTopLevelInfoRequest('6a1b2c3d4e5f60718293a4b5');
        $this->client->expects($this->once())->method('changingTopLevelInfo')->with($request)->willReturn($this->fixture('applicant_company.json'));

        $applicant = $this->api->changingTopLevelInfo($request);

        $this->assertInstanceOf(ApplicantData::class, $applicant);
        $this->assertSame('6a1b2c3d4e5f60718293a4b5', $applicant->id);
    }

    public function testChangingTopLevelInfoNotFound(): void
    {
        $request = new ChangingTopLevelInfoRequest('abc123');
        $this->client->expects($this->once())->method('changingTopLevelInfo')->willThrowException(new ClientException('Not Found', new Request('PATCH', '/x'), new Response(404)));

        $this->expectException(ApplicantNotFoundException::class);
        $this->expectExceptionMessage('Applicant not found. ApplicantId: abc123. ExternalUserId: ');

        $this->api->changingTopLevelInfo($request);
    }

    public function testChangingTopLevelInfoRethrowsOtherHttpErrors(): void
    {
        $this->client->expects($this->once())->method('changingTopLevelInfo')->willThrowException(new ClientException('Bad Request', new Request('PATCH', '/x'), new Response(400)));

        $this->expectException(ClientException::class);
        $this->expectExceptionCode(400);

        $this->api->changingTopLevelInfo(new ChangingTopLevelInfoRequest('abc123'));
    }

    public function testResetApplicant(): void
    {
        $request = new ResetApplicantRequest('abc123');
        $this->client->expects($this->once())->method('resetApplicant')->with($request)->willReturn($this->fixture('ok.json'));

        $response = $this->api->resetApplicant($request);

        $this->assertInstanceOf(OkResponse::class, $response);
        $this->assertSame(1, $response->ok);
    }

    public function testResetApplicantNotFound(): void
    {
        $this->client->expects($this->once())->method('resetApplicant')->willThrowException(new ClientException('Not Found', new Request('POST', '/x'), new Response(404)));

        $this->expectException(ApplicantNotFoundException::class);
        $this->expectExceptionCode(404);

        $this->api->resetApplicant(new ResetApplicantRequest('abc123'));
    }

    public function testResetApplicantRethrowsOtherHttpErrors(): void
    {
        $this->client->expects($this->once())->method('resetApplicant')->willThrowException(new ServerException('Server Error', new Request('POST', '/x'), new Response(503)));

        $this->expectException(ServerException::class);
        $this->expectExceptionCode(503);

        $this->api->resetApplicant(new ResetApplicantRequest('abc123'));
    }

    public function testInvalidJsonResponseThrowsParseJsonException(): void
    {
        $this->client->expects($this->once())->method('createAccessToken')->willReturn('<html>Bad Gateway</html>');

        $this->expectException(ParseJsonException::class);

        $this->api->createAccessToken(new CreateAccessTokenRequest(new Level('basic-kyc-level'), 'user-42'));
    }
}
