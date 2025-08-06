<?php

namespace Shureban\LaravelSumsubSdk;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Shureban\LaravelSumsubSdk\Attributes\Signature;
use Shureban\LaravelSumsubSdk\Dto\Requests\ChangingTopLevelInfoRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateAccessTokenRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateApplicantRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\GetApplicantDataRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\ResetApplicantRequest;
use Symfony\Component\HttpFoundation\Request as LaravelRequest;

class Client
{
    private GuzzleClient $client;
    private Router       $router;
    private string       $apiKey;
    private string       $secretKey;

    public function __construct(string $apiKey, string $secretKey)
    {
        $this->apiKey    = $apiKey;
        $this->secretKey = $secretKey;
        $this->router    = new Router();
        $this->client    = new GuzzleClient([
            'base_uri'        => config('sumsub.domain'),
            'timeout'         => config('sumsub.timeout'),
            'connect_timeout' => config('sumsub.timeout'),
        ]);
    }

    /**
     * @param CreateAccessTokenRequest $request
     *
     * @return string
     * @throws GuzzleException
     */
    public function createAccessToken(CreateAccessTokenRequest $request): string
    {
        $url     = sprintf('%s?%s', $this->router->createAccessToken(), $request->queryParams());
        $request = new Request(LaravelRequest::METHOD_POST, $url);

        return $this->sendRequest($request)->getBody()->getContents();
    }

    /**
     * @param CreateApplicantRequest $request
     *
     * @return string
     * @throws GuzzleException
     */
    public function createApplicant(CreateApplicantRequest $request): string
    {
        $url     = sprintf('%s?%s', $this->router->createApplicant(), $request->queryParams());
        $body    = json_encode($request->body());
        $request = new Request(LaravelRequest::METHOD_POST, $url, [], $body);

        return $this->sendRequest($request)->getBody()->getContents();
    }

    /**
     * @param GetApplicantDataRequest $request
     *
     * @return string
     * @throws GuzzleException
     */
    public function getApplicantData(GetApplicantDataRequest $request): string
    {
        $url = $this->router->getApplicantDataByExternalUserId($request->externalUserId);
        if ($request->applicantId) {
            $url = $this->router->getApplicantDataByApplicantId($request->applicantId);
        }

        $httpRequest = new Request(LaravelRequest::METHOD_GET, $url);

        return $this->sendRequest($httpRequest)->getBody()->getContents();
    }

    /**
     * @param ChangingTopLevelInfoRequest $request
     *
     * @return string
     * @throws GuzzleException
     */
    public function changingTopLevelInfo(ChangingTopLevelInfoRequest $request): string
    {
        $url     = $this->router->changingTopLevelInfo();
        $body    = json_encode($request->body());
        $request = new Request(LaravelRequest::METHOD_PATCH, $url, [], $body);

        return $this->sendRequest($request)->getBody()->getContents();
    }

    /**
     * @param ResetApplicantRequest $request
     *
     * @return string
     * @throws GuzzleException
     */
    public function resetApplicant(ResetApplicantRequest $request): string
    {
        $url     = $this->router->resetApplicant($request->applicantId);
        $request = new Request(LaravelRequest::METHOD_POST, $url, []);

        return $this->sendRequest($request)->getBody()->getContents();
    }

    public function getApplicantStatus(): void
    {

    }

    public function addDocument(): void
    {

    }

    public function changeLevel(): void
    {

    }

    /**
     * @param Request $request
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    private function sendRequest(Request $request): ResponseInterface
    {
        $time      = time();
        $url       = trim(sprintf('%s?%s', $request->getUri()->getPath(), $request->getUri()->getQuery()), '?');
        $signature = (string)new Signature($this->secretKey, $url, $time, $request->getMethod(), (string)$request->getBody());

        $request = $request->withHeader('Content-Type', 'application/json');
        $request = $request->withHeader('X-App-Token', $this->apiKey);
        $request = $request->withHeader('X-App-Access-Sig', $signature);
        $request = $request->withHeader('X-App-Access-Ts', $time);

        return $this->client->send($request);
    }
}

