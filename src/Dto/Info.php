<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use DateTime;
use Shureban\LaravelSumsubSdk\Enums\Country;

class Info
{
    public ?string      $firstName;
    public ?string      $firstNameEn;
    public ?string      $lastName;
    public ?string      $lastNameEn;
    public ?DateTime    $dob;
    public ?CompanyInfo $companyInfo = null;
    public ?Country     $country;
    /** @var Address[] */
    public array $addresses = [];
    /** @var IdDoc[] */
    public array $idDocs = [];
}
