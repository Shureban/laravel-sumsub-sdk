<?php

namespace Shureban\LaravelSumsubSdk;

class Router
{
    /**
     * @return string
     */
    public function createApplicant(): string
    {
        return '/resources/applicants';
    }

    /**
     * @return string
     */
    public function createAccessToken(): string
    {
        return '/resources/accessTokens';
    }

    /**
     * @param string $applicantId
     *
     * @return string
     */
    public function getApplicantDataByApplicantId(string $applicantId): string
    {
        return sprintf('/resources/applicants/%s/one', $applicantId);
    }

    /**
     * @param string $externalUserId
     *
     * @return string
     */
    public function getApplicantDataByExternalUserId(string $externalUserId): string
    {
        return sprintf('/resources/applicants/-;externalUserId=%s/one', $externalUserId);
    }
}