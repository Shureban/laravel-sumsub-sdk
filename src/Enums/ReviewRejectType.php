<?php

namespace Shureban\LaravelSumsubSdk\Enums;

enum ReviewRejectType: string
{
    case Retry = 'RETRY';
    case Final = 'FINAL';
}
