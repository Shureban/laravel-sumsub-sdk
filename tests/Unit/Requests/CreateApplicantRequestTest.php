<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit\Requests;

use Shureban\LaravelSumsubSdk\Attributes\Level;
use Shureban\LaravelSumsubSdk\Dto\Requests\CreateApplicantRequest;
use Shureban\LaravelSumsubSdk\Tests\TestCase;

class CreateApplicantRequestTest extends TestCase
{
    public function testQueryParamsContainOnlyLevelName(): void
    {
        $request = new CreateApplicantRequest(new Level('basic-kyb-level'), 'company-7');

        $this->assertSame('levelName=basic-kyb-level', $request->queryParams());
    }

    public function testBodyContainsOnlyExternalUserId(): void
    {
        $request = new CreateApplicantRequest(new Level('basic-kyb-level'), 'company-7');

        $this->assertSame(['externalUserId' => 'company-7'], $request->body());
        $this->assertSame('{"externalUserId":"company-7"}', json_encode($request->body()));
    }

    public function testToArrayExposesBothProperties(): void
    {
        $level   = new Level('basic-kyb-level');
        $request = new CreateApplicantRequest($level, 'company-7');

        $this->assertSame(['externalUserId' => 'company-7', 'levelName' => $level], $request->toArray());
    }
}
