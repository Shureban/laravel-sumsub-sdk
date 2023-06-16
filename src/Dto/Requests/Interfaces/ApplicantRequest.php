<?php

namespace Shureban\LaravelSumsubSdk\Dto\Requests\Interfaces;

interface ApplicantRequest
{
    public function getApplicantId(): ?string;

    public function getExternalUserId(): ?string;
}