<?php

namespace Shureban\LaravelSumsubSdk\Exceptions;

use Exception;
use Shureban\LaravelSumsubSdk\Dto\Requests\GetApplicantDataRequest;
use Throwable;

class ApplicantNotFoundException extends Exception
{
    public function __construct(GetApplicantDataRequest $request, int $code = 0, ?Throwable $previous = null)
    {
        $message = sprintf(trans('Applicant not found. ApplicantId: %s. ExternalUserId: %s'), $request->applicantId, $request->externalUserId);

        parent::__construct($message, $code, $previous);
    }
}
