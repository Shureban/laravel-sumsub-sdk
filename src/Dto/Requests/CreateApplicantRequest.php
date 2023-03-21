<?php

namespace Shureban\LaravelSumsubSdk\Dto\Requests;

use Shureban\LaravelSumsubSdk\Attributes\Level;

class CreateApplicantRequest extends SumsubRequest
{
    public string $externalUserId;
    public Level  $levelName;

    /**
     * @param Level  $levelName
     * @param string $externalUserId
     */
    public function __construct(Level $levelName, string $externalUserId)
    {
        $this->levelName      = $levelName;
        $this->externalUserId = $externalUserId;
    }

    /**
     * @return string
     */
    public function queryParams(): string
    {
        return http_build_query([
            'levelName' => (string)$this->levelName,
        ]);
    }

    /**
     * @return array
     */
    public function body(): array
    {
        return [
            'externalUserId' => $this->externalUserId,
        ];
    }
}