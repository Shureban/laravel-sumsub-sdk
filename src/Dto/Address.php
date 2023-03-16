<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use Shureban\LaravelSumsubSdk\Enums\Country;

class Address
{
    public ?Country $country        = null;
    public ?string  $postCode       = null;
    public ?string  $town           = null;
    public ?string  $townEn         = null;
    public ?string  $street         = null;
    public ?string  $streetEn       = null;
    public ?string  $subStreet      = null;
    public ?string  $subStreetEn    = null;
    public ?string  $state          = null;
    public ?string  $buildingName   = null;
    public ?string  $flatNumber     = null;
    public ?string  $buildingNumber = null;
}
