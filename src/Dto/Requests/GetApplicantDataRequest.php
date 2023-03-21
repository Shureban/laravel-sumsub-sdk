<?php

namespace Shureban\LaravelSumsubSdk\Dto\Requests;

class GetApplicantDataRequest extends SumsubRequest
{
    public string  $externalUserId;
    public ?string $applicantId;

    /**
     * @param string      $externalUserId
     * @param string|null $applicantId
     */
    public function __construct(string $externalUserId, string $applicantId = null)
    {
        $this->externalUserId = $externalUserId;
        $this->applicantId    = $applicantId;
    }

    /**
     * @return string
     */
    public function queryParams(): string
    {
        return http_build_query([
            'externalUserId' => $this->externalUserId,
            'applicantId'    => $this->applicantId,
        ]);
    }
}