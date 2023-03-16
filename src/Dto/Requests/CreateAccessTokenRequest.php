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
}