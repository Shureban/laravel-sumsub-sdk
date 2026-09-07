<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit\Requests;

use Shureban\LaravelSumsubSdk\Attributes\Level;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateAccessTokenRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\SumsubRequest;
use Shureban\LaravelSumsubSdk\Tests\TestCase;

class CreateAccessTokenRequestTest extends TestCase
{
    public function testTtlIsTakenFromConfig(): void
    {
        $request = new CreateAccessTokenRequest(new Level('basic-kyc-level'), 'user-42');

        $this->assertInstanceOf(SumsubRequest::class, $request);
        $this->assertSame(600, $request->ttlInSecs);
        $this->assertSame('user-42', $request->userId);
        $this->assertSame('basic-kyc-level', (string)$request->levelName);
        $this->assertNull($request->externalActionId);
    }

    public function testQueryParamsSkipNullExternalActionId(): void
    {
        $request = new CreateAccessTokenRequest(new Level('basic-kyc-level'), 'user-42');

        $this->assertSame('ttlInSecs=600&userId=user-42&levelName=basic-kyc-level', $request->queryParams());
    }

    public function testQueryParamsIncludeExternalActionIdAndCustomTtl(): void
    {
        $request                   = new CreateAccessTokenRequest(new Level('basic kyc'), 'user 42');
        $request->ttlInSecs        = 1200;
        $request->externalActionId = 'action-1';

        $this->assertSame('ttlInSecs=1200&userId=user+42&levelName=basic+kyc&externalActionId=action-1', $request->queryParams());
    }

    public function testBodyExposesAllPublicProperties(): void
    {
        $request = new CreateAccessTokenRequest(new Level('basic-kyc-level'), 'user-42');

        $this->assertSame(['ttlInSecs', 'userId', 'levelName', 'externalActionId'], array_keys($request->body()));
        $this->assertSame($request->toArray(), $request->body());
    }
}
