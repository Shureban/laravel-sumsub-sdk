<?php

namespace Shureban\LaravelSumsubSdk\Dto\Requests;

use Shureban\LaravelSumsubSdk\Attributes\Level;

class CreateAccessTokenRequest extends SumsubRequest
{
    public int     $ttlInSecs;
    public string  $userId;
    public Level   $levelName;
    public ?string $externalActionId = null;

    public function __construct(Level $levelName, string $userId)
    {
        $this->levelName = $levelName;
        $this->userId    = $userId;
        $this->ttlInSecs = config('sumsub.access_token_life_time');
    }

    /**
     * @return string
     */
    public function queryParams(): string
    {
        return http_build_query([
            'ttlInSecs'        => $this->ttlInSecs,
            'userId'           => $this->userId,
            'levelName'        => (string)$this->levelName,
            'externalActionId' => $this->externalActionId,
        ]);
    }
}