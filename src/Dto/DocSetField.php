<?php

namespace Shureban\LaravelSumsubSdk\Dto;

class DocSetField
{
    public string $name;
    public bool   $required;
    public ?bool  $prefill            = null;
    public ?bool  $immutableIfPresent = null;
}