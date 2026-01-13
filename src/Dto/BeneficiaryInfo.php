<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use DateTime;

class BeneficiaryInfo
{
    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?DateTime $dob = null;
    public ?string $email = null;
    public ?string $taxResidenceCountry = null;
    public ?float $shareSize = null;
}
