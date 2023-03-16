<?php

namespace Shureban\LaravelSumsubSdk\Dto;

class DocSetField
{
    public string  $name;
    public ?string $displayName = null;
    public bool    $required;
}