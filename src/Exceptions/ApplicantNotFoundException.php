<?php

namespace Shureban\LaravelSumsubSdk\Exceptions;

use Exception;
use Shureban\LaravelSumsubSdk\Dto\Requests\Interfaces\ApplicantRequest;
use Throwable;

class ApplicantNotFoundException extends Exception
{
    public function __construct(ApplicantRequest $request, int $code = 0, ?Throwable $previous = null)
    {
        $message = sprintf(trans('Applicant not found. ApplicantId: %s. ExternalUserId: %s'), $request->getApplicantId(), $request->getExternalUserId());

        parent::__construct($message, $code, $previous);
    }
}
