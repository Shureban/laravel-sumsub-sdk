<?php

namespace Shureban\LaravelSumsubSdk\Dto;

class Questionnaire
{
    public string $id;
    public float  $score;
    /** @var object[] */
    public array $sections;
}
