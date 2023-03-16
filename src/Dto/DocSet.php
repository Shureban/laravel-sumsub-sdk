<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use Shureban\LaravelSumsubSdk\Enums\DocSetType;
use Shureban\LaravelSumsubSdk\Enums\DocSubType;
use Shureban\LaravelSumsubSdk\Enums\IdDocType;

class DocSet
{
    public DocSetType $idDocSetType;
    /** @var DocSetField[] */
    public array $fields = [];
    /** @var DocSetField[] */
    public array $customFields = [];
    /** @var IdDocType[] */
    public array $types = [];
    /** @var DocSubType[] */
    public array   $subTypes      = [];
    public ?string $videoRequired = null;
}