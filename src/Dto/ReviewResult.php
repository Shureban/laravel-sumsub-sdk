<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use Shureban\LaravelSumsubSdk\Enums\RejectLabel;
use Shureban\LaravelSumsubSdk\Enums\ReviewAnswer;
use Shureban\LaravelSumsubSdk\Enums\ReviewRejectType;

class ReviewResult
{
    /** @var RejectLabel[] */
    public array             $rejectLabels     = [];
    public ?ReviewRejectType $reviewRejectType = null;
    public ReviewAnswer      $reviewAnswer;
    public string            $moderationComment;
    public string            $clientComment;
}