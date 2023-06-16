<?php

namespace Shureban\LaravelSumsubSdk\Dto\Requests;

use Shureban\LaravelSumsubSdk\Dto\Requests\Interfaces\ApplicantRequest;
use Shureban\LaravelSumsubSdk\Enums\ApplicantType;

class ChangingTopLevelInfoRequest extends SumsubRequest implements ApplicantRequest
{
    public string         $id;
    public ?string        $externalUserId = null;
    public ?string        $email          = null;
    public ?string        $phone          = null;
    public ?ApplicantType $type           = null;
    public ?string        $sourceKey      = null;
    public ?string        $lang           = null;
    public ?array         $questionnaires = null;
    public ?array         $metadata       = null;
    public ?bool          $deleted        = null;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function body(): array
    {
        return [
            'id'             => $this->id,
            'externalUserId' => $this->externalUserId,
            'email'          => $this->email,
            'phone'          => $this->phone,
            'type'           => $this->type,
            'sourceKey'      => $this->sourceKey,
            'lang'           => $this->lang,
            'questionnaires' => $this->questionnaires,
            'metadata'       => $this->metadata,
            'deleted'        => $this->deleted,
        ];
    }

    public function getApplicantId(): ?string
    {
        return $this->id;
    }

    public function getExternalUserId(): ?string
    {
        return $this->externalUserId;
    }
}
