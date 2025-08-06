<?php

namespace Shureban\LaravelSumsubSdk;

use GuzzleHttp\Exception\GuzzleException;
use Shureban\LaravelObjectMapper\Exceptions\ParseJsonException;
use Shureban\LaravelObjectMapper\ObjectMapper;
use Shureban\LaravelSumsubSdk\Dto\Requests\ChangingTopLevelInfoRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateAccessTokenRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateApplicantRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\GetApplicantDataRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\ResetApplicantRequest;
use Shureban\LaravelSumsubSdk\Dto\Responses\AccessToken;
use Shureban\LaravelSumsubSdk\Dto\Responses\ApplicantData;
use Shureban\LaravelSumsubSdk\Dto\Responses\OkResponse;
use Shureban\LaravelSumsubSdk\Exceptions\ApplicantNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class SumsubApi
{
    private Client $client;

    public function __construct(string $apiKey)
    {
        $this->client = new Client($apiKey);
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
        $body = $this->client->createAccessToken($request);

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
        $body = $this->client->createApplicant($request);

        return (new ObjectMapper(new ApplicantData()))->mapFromJson($body);
    }

    /**
     * @param GetApplicantDataRequest $request
     *
     * @return ApplicantData
     * @throws ApplicantNotFoundException
     * @throws ParseJsonException|GuzzleException
     */
    public function getApplicantData(GetApplicantDataRequest $request): ApplicantData
    {
        try {
            $body = $this->client->getApplicantData($request);
        }
        catch (GuzzleException $e) {
            match ($e->getCode()) {
                Response::HTTP_NOT_FOUND => throw new ApplicantNotFoundException($request, $e->getCode(), $e->getPrevious()),
                default                  => throw new $e,
            };
        }

        return (new ObjectMapper(new ApplicantData()))->mapFromJson($body);
    }

    /**
     * @param ChangingTopLevelInfoRequest $request
     *
     * @return ApplicantData
     * @throws ApplicantNotFoundException
     * @throws GuzzleException
     * @throws ParseJsonException
     */
    public function changingTopLevelInfo(ChangingTopLevelInfoRequest $request): ApplicantData
    {
        try {
            $body = $this->client->changingTopLevelInfo($request);
        }
        catch (GuzzleException $e) {
            match ($e->getCode()) {
                Response::HTTP_NOT_FOUND => throw new ApplicantNotFoundException($request, $e->getCode(), $e->getPrevious()),
                default                  => throw new $e,
            };
        }

        return (new ObjectMapper(new ApplicantData()))->mapFromJson($body);
    }

    /**
     * @param ResetApplicantRequest $request
     *
     * @return OkResponse
     * @throws ApplicantNotFoundException
     * @throws GuzzleException
     * @throws ParseJsonException
     */
    public function resetApplicant(ResetApplicantRequest $request): OkResponse
    {
        try {
            $body = $this->client->resetApplicant($request);
        }
        catch (GuzzleException $e) {
            match ($e->getCode()) {
                Response::HTTP_NOT_FOUND => throw new ApplicantNotFoundException($request, $e->getCode(), $e->getPrevious()),
                default                  => throw new $e,
            };
        }

        return (new ObjectMapper(new OkResponse()))->mapFromJson($body);
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
}

