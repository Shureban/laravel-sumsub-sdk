<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use DateTime;
use Shureban\LaravelSumsubSdk\Enums\Country;

class Info
{
    public ?string      $firstName   = null;
    public ?string      $firstNameEn = null;
    public ?string      $lastName    = null;
    public ?string      $lastNameEn  = null;
    public ?DateTime    $dob         = null;
    public ?CompanyInfo $companyInfo = null;
    public ?Country     $country     = null;
    /** @var Address[] */
    public array $addresses = [];
    /** @var IdDoc[] */
    public array $idDocs = [];
}
