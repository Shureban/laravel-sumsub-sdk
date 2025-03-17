<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use Shureban\LaravelSumsubSdk\Enums\DocSubType;

class DocSet
{
    public string $idDocSetType;
    /** @var DocSetField[] */
    public array $fields = [];
    /** @var DocSetField[] */
    public array $customFields = [];
    /** @var string[] */
    public array $types = [];
    /** @var DocSubType[] */
    public array   $subTypes      = [];
    public ?string $videoRequired = null;
}