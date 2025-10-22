<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use Shureban\LaravelSumsubSdk\Enums\Country;

class CompanyInfo
{
    public string   $companyName        = "";
    public string   $registrationNumber = "";
    public ?Country $country;
    public string   $legalAddress       = "";
    public string   $phone              = "";
    public string   $website            = "";
    public string   $postalAddress      = "";
    /** @var Beneficiary[] $beneficiaries */
    public array $beneficiaries = [];
}
