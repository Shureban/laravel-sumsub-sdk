<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use DateTime;

class Agreement
{
    public ?string $source  = null;
    public ?string $link    = null;
    public mixed   $content = null;
    /** @var string[] */
    public array    $targets = [];
    public DateTime $createdAt;
}
