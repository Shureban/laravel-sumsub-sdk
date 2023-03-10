<?php

namespace Shureban\LaravelSumsubSdk;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Shureban\LaravelObjectMapper\Exceptions\ParseJsonException;
use Shureban\LaravelObjectMapper\ObjectMapper;
use Shureban\LaravelSumsubSdk\Attributes\Level;
use Shureban\LaravelSumsubSdk\Attributes\Signature;
use Shureban\LaravelSumsubSdk\Dto\Responses\CreateAccessTokenResponse;
use Shureban\LaravelSumsubSdk\Dto\Responses\CreateApplicantResponse;

class Api
{
    private Client $client;
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->client = new Client([
            'base_uri' => config('sumsub.domain'),
        ]);
    }

    /**
     * @param Level  $level
     * @param string $externalUserId
     *
     * @return CreateApplicantResponse
     * @throws GuzzleException
     * @throws ParseJsonException
     */
    public function createApplicant(Level $level, string $externalUserId): CreateApplicantResponse
    {
        $time    = time();
        $url     = sprintf('%s?levelName=%s', $this->router->createApplicant(), $level);
        $body    = json_encode(['externalUserId' => $externalUserId]);
        $request = $this->client->post($url, [
            'headers'         => [
                'Content-Type'     => 'application/json',
                'X-App-Token'      => config('sumsub.api_key'),
                'X-App-Access-Sig' => (string)new Signature($url, $time, 'POST', $body),
                'X-App-Access-Ts'  => $time,
            ],
            'timeout'         => config('sumsub.timeout'),
            'connect_timeout' => config('sumsub.timeout'),
            'body'            => $body,
        ]);
        $body    = $request->getBody()->getContents();

        return (new ObjectMapper(new CreateApplicantResponse()))->mapFromJson($body);
    }

    /**
     * @param Level  $level
     * @param string $externalUserId
     *
     * @return CreateAccessTokenResponse
     * @throws GuzzleException
     * @throws ParseJsonException
     */
    public function createAccessToken(Level $level, string $externalUserId): CreateAccessTokenResponse
    {
        $time    = time();
        $url     = sprintf('%s?userId=%s&levelName=%s', $this->router->createAccessToken(), $externalUserId, $level);
        $request = $this->client->post($url, [
            'headers'         => [
                'Content-Type'     => 'application/json',
                'X-App-Token'      => config('sumsub.api_key'),
                'X-App-Access-Sig' => (string)new Signature($url, $time, 'POST'),
                'X-App-Access-Ts'  => $time,
            ],
            'timeout'         => config('sumsub.timeout'),
            'connect_timeout' => config('sumsub.timeout'),
        ]);
        $body    = $request->getBody()->getContents();

        return (new ObjectMapper(new CreateAccessTokenResponse()))->mapFromJson($body);
    }

    public function addDocument(): void
    {

    }

    public function getApplicantStatus(): void
    {

    }

    public function getApplicantData(): void
    {

    }

    public function changeLevel(): void
    {

    }

    private function sendRequest(): void
    {

    }
}

