<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use DateTime;
use Shureban\LaravelSumsubSdk\Enums\Country;
use Shureban\LaravelSumsubSdk\Enums\Gender;

class FixedInfo
{
    public ?string      $firstName      = null;
    public ?string      $lastName       = null;
    public ?string      $middleName     = null;
    public ?string      $firstNameEn    = null;
    public ?string      $lastNameEn     = null;
    public ?string      $middleNameEn   = null;
    public ?string      $legalName      = null;
    public ?Gender      $gender         = null;
    public ?DateTime    $dob            = null;
    public ?CompanyInfo $companyInfo    = null;
    public ?string      $placeOfBirth   = null;
    public ?string      $countryOfBirth = null;
    public ?string      $stateOfBirth   = null;
    public ?Country     $country        = null;
    public ?Country     $nationality    = null;
    /** @var Address[] */
    public array   $addresses = [];
    public ?string $tin       = null;
}
