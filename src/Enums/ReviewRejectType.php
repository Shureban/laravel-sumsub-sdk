<?php

namespace Shureban\LaravelSumsubSdk\Enums;

enum ReviewRejectType: string
{
    case RETRY = 'RETRY';
    case FINAL = 'FINAL';
}
