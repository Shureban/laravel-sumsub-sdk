<?php

namespace Shureban\LaravelSumsubSdk\Dto;

use DateTime;
use Shureban\LaravelSumsubSdk\Attributes\Level;
use Shureban\LaravelSumsubSdk\Enums\ReviewStatus;

class Review
{
    public ReviewStatus  $reviewStatus;
    public Level         $levelName;
    public ?int          $priority              = null;
    public ?string       $reviewId              = null;
    public ?string       $attemptId             = null;
    public ?int          $attemptCnt            = null;
    public ?int          $elapsedSincePendingMs = null;
    public ?int          $elapsedSinceQueuedMs  = null;
    public ?bool         $reprocessing          = null;
    public ?ReviewResult $reviewResult          = null;
    public DateTime      $createDate;
    public ?DateTime     $reviewDate            = null;
}
