<?php

namespace Shureban\LaravelSumsubSdk\Enums;

enum ReviewStatus: string
{
    case Init       = 'init';
    case Pending    = 'pending';
    case Prechecked = 'prechecked';
    case Queued     = 'queued';
    case Completed  = 'completed';
    case OnHold     = 'on_hold';
}
