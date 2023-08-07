<?php

namespace Shureban\LaravelSumsubSdk\Dto\Requests;

use Shureban\LaravelSumsubSdk\Dto\Requests\Interfaces\ApplicantRequest;

class ResetApplicantRequest extends SumsubRequest implements ApplicantRequest
{
    public string $applicantId;

    /**
     * @param string $applicantId
     */
    public function __construct(string $applicantId)
    {
        $this->applicantId = $applicantId;
    }

    public function getApplicantId(): ?string
    {
        return $this->applicantId;
    }

    public function getExternalUserId(): ?string
    {
        return null;
    }
}
