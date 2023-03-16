<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use stdClass;

class Questionnaire
{
    public string $id;
    public float  $score;
    /** @var stdClass[] */
    public array $sections;
}
