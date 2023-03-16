<?php

namespace Shureban\LaravelSumsubSdk\Dto\Responses;

use DateTime;
use Shureban\LaravelSumsubSdk\Dto\Agreement;
use Shureban\LaravelSumsubSdk\Dto\FixedInfo;
use Shureban\LaravelSumsubSdk\Dto\Info;
use Shureban\LaravelSumsubSdk\Dto\MetaData;
use Shureban\LaravelSumsubSdk\Dto\Questionnaire;
use Shureban\LaravelSumsubSdk\Dto\RequiredIdDoc;
use Shureban\LaravelSumsubSdk\Dto\Review;
use Shureban\LaravelSumsubSdk\Enums\ApplicantType;
use Shureban\LaravelSumsubSdk\Enums\Country;
use stdClass;

class ApplicantData
{
    public string        $id;
    public string        $key;
    public ApplicantType $type;
    public string        $clientId;
    public string        $inspectionId;
    public string        $externalUserId;
    public string        $applicantPlatform;
    public ?string       $sourceKey = null;
    public ?string       $authCode  = null;
    public ?string       $email     = null;
    public ?string       $phone     = null;
    public ?string       $lang      = null;
    public ?Country      $ipCountry = null;
    /** @var MetaData[] */
    public array          $metadata       = [];
    public ?Agreement     $agreement      = null;
    public ?Info          $info           = null;
    public ?FixedInfo     $fixedInfo      = null;
    public ?RequiredIdDoc $requiredIdDocs = null;
    public Review         $review;
    /** @var Questionnaire[] */
    public array $questionnaires = [];
    /** @var stdClass[] */
    public array    $inspectionMetadata = [];
    public DateTime $createdAt;
}
