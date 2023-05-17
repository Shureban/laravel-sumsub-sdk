<?php

namespace Shureban\LaravelSumsubSdk\Enums;

enum BeneficiaryType: string
{
    case Director       = 'director';
    case Shareholder    = 'shareholder';
    case UBO            = 'ubo';
    case Representative = 'representative';
}
