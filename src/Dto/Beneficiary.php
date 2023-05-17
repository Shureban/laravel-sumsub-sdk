<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use Shureban\LaravelSumsubSdk\Enums\BeneficiaryType;

class Beneficiary
{
    public string          $applicantId;
    public ?array          $positions  = null;
    public BeneficiaryType $type;
    public bool            $inRegistry = false;
    public ?array          $imageIds   = null;
    public mixed           $applicant  = null;
    public ?float          $shareSize  = null;
}
