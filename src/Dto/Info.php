<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use Shureban\LaravelSumsubSdk\Enums\Country;

class Info
{
    public ?CompanyInfo $companyInfo = null;
    public ?Country     $country;
    /** @var IdDoc[] */
    public array $idDocs = [];
}
