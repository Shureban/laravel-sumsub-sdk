<?php

namespace Shureban\LaravelSumsubSdk\Dto\Webhooks;

use DateTime;
use Shureban\LaravelSumsubSdk\Attributes\Level;
use Shureban\LaravelSumsubSdk\Enums\ApplicantType;
use Shureban\LaravelSumsubSdk\Enums\ReviewStatus;
use Shureban\LaravelSumsubSdk\Enums\WebhookType;

class CreatedApplicant
{
    public string        $applicantId;
    public string        $inspectionId;
    public ApplicantType $applicantType;
    public string        $correlationId;
    public Level         $levelName;
    public bool          $sandboxMode;
    public string        $externalUserId;
    public WebhookType   $type;
    public ReviewStatus  $reviewStatus;
    public DateTime      $createdAt;
    public DateTime      $createdAtMs;
    public string        $clientId;
}
