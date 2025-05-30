<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use Shureban\LaravelSumsubSdk\Enums\ReviewAnswer;
use Shureban\LaravelSumsubSdk\Enums\ReviewRejectType;

class ReviewResult
{
    /** @var string[] */
    public array             $rejectLabels     = [];
    public ?ReviewRejectType $reviewRejectType = null;
    public ?ReviewAnswer     $reviewAnswer     = null;
    public string            $moderationComment;
    public string            $clientComment;
}