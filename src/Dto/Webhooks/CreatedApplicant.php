<?php

namespace Shureban\LaravelSumsubSdk\Dto\Webhooks;

use DateTime;
use Shureban\LaravelSumsubSdk\Attributes\Level;
use Shureban\LaravelSumsubSdk\Dto\ReviewResult;
use Shureban\LaravelSumsubSdk\Enums\ApplicantType;
use Shureban\LaravelSumsubSdk\Enums\ReviewStatus;
use Shureban\LaravelSumsubSdk\Enums\WebhookType;

class CreatedApplicant
{
    public string         $clientId;
    public string         $applicantId;
    public string         $inspectionId;
    public string         $correlationId;
    public string         $externalUserId;
    public ?string        $applicantActionId         = null;
    public ?string        $externalApplicantActionId = null;
    public ?Level         $levelName                 = null;
    public bool           $sandboxMode;
    public WebhookType    $type;
    public ?ApplicantType $applicantType             = null;
    public ReviewStatus   $reviewStatus;
    public ?ReviewResult  $reviewResult              = null;
    public ?ReviewStatus  $videoIdentReviewStatus    = null;
    public ?array         $applicantMemberOf         = null;
    public DateTime       $createdAt;
    public DateTime       $createdAtMs;
}
