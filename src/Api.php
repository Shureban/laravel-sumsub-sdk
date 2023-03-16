<?php

namespace Shureban\LaravelSumsubSdk;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Shureban\LaravelObjectMapper\Exceptions\ParseJsonException;
use Shureban\LaravelObjectMapper\ObjectMapper;
use Shureban\LaravelSumsubSdk\Attributes\Signature;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateAccessTokenRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateApplicantRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\GetApplicantDataRequest;
use Shureban\LaravelSumsubSdk\Dto\Responses\AccessToken;
use Shureban\LaravelSumsubSdk\Dto\Responses\ApplicantData;
use Symfony\Component\HttpFoundation\Request as LaravelRequest;

class Api
{
    private Client $client;
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->client = new Client([
            'base_uri'        => config('sumsub.domain'),
            'timeout'         => config('sumsub.timeout'),
            'connect_timeout' => config('sumsub.timeout'),
        ]);
    }

    /**
     * @param CreateAccessTokenRequest $request
     *
     * @return AccessToken
     * @throws GuzzleException
     * @throws ParseJsonException
     */
    public function createAccessToken(CreateAccessTokenRequest $request): AccessToken
    {
        $url     = sprintf('%s?%s', $this->router->createAccessToken(), $request->queryParams());
        $request = new Request(LaravelRequest::METHOD_POST, $url);
        $body    = $this->sendRequest($request)->getBody()->getContents();

        return (new ObjectMapper(new AccessToken()))->mapFromJson($body);
    }

    /**
     * @param CreateApplicantRequest $request
     *
     * @return ApplicantData
     * @throws GuzzleException
     * @throws ParseJsonException
     */
    public function createApplicant(CreateApplicantRequest $request): ApplicantData
    {
        $url     = sprintf('%s?%s', $this->router->createApplicant(), $request->queryParams());
        $body    = json_encode($request->body());
        $request = new Request(LaravelRequest::METHOD_POST, $url, [], $body);
        $body    = $this->sendRequest($request)->getBody()->getContents();

        return (new ObjectMapper(new ApplicantData()))->mapFromJson($body);
    }

    /**
     * @param GetApplicantDataRequest $request
     *
     * @return ApplicantData
     * @throws GuzzleException
     * @throws ParseJsonException
     */
    public function getApplicantData(GetApplicantDataRequest $request): ApplicantData
    {
        $url = $this->router->getApplicantDataByExternalUserId($request->externalUserId);
        if ($request->applicantId) {
            $url = $this->router->getApplicantDataByApplicantId($request->applicantId);
        }

        $request = new Request(LaravelRequest::METHOD_GET, $url);
        $body    = $this->sendRequest($request)->getBody()->getContents();

        return (new ObjectMapper(new ApplicantData()))->mapFromJson($body);
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
        $signature = (string)new Signature($url, $time, $request->getMethod(), (string)$request->getBody());

        $request = $request->withHeader('Content-Type', 'application/json');
        $request = $request->withHeader('X-App-Token', config('sumsub.api_key'));
        $request = $request->withHeader('X-App-Access-Sig', $signature);
        $request = $request->withHeader('X-App-Access-Ts', $time);

        return $this->client->send($request);
    }
}

