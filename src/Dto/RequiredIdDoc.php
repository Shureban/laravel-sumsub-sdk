<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use Shureban\LaravelSumsubSdk\Enums\Country;

class RequiredIdDoc
{
    /** @var Country[] */
    public array $excludedCountries = [];
    /** @var DocSet[] */
    public array $docSets = [];
}
