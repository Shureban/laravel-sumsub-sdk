<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use Shureban\LaravelSumsubSdk\Enums\Country;
use Shureban\LaravelSumsubSdk\Enums\IdDocType;

class IdDoc
{
    public Country   $country;
    public IdDocType $idDocType;
}
