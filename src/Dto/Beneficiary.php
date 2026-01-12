<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use Shureban\LaravelSumsubSdk\Dto\Responses\ApplicantData;
use Shureban\LaravelSumsubSdk\Enums\BeneficiaryType;

class Beneficiary
{
    public string           $id;
    public ?ApplicantData   $applicant;
    public string           $applicantId;
    /** @var BeneficiaryType[] */
    public ?array           $types = null;
    public ?float           $shareSize  = null;
    public ?BeneficiaryInfo $beneficiaryInfo = null;
}
