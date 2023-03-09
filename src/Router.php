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
}