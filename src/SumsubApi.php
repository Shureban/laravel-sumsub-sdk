<?php

namespace Shureban\LaravelSumsubSdk;

use GuzzleHttp\Exception\GuzzleException;
use Shureban\LaravelObjectMapper\Exceptions\ParseJsonException;
use Shureban\LaravelObjectMapper\ObjectMapper;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateAccessTokenRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateApplicantRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\GetApplicantDataRequest;
use Shureban\LaravelSumsubSdk\Dto\Responses\AccessToken;
use Shureban\LaravelSumsubSdk\Dto\Responses\ApplicantData;
use Shureban\LaravelSumsubSdk\Exceptions\ApplicantNotFoundException;

class SumsubApi
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
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
     * @throws ParseJsonException
     */
    public function getApplicantData(GetApplicantDataRequest $request): ApplicantData
    {
        try {
            $body = $this->client->getApplicantData($request);
        }
        catch (GuzzleException $e) {
            throw new ApplicantNotFoundException($request, $e->getCode(), $e->getPrevious());
        }

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
}

