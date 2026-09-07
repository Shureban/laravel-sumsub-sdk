<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit\Requests;

use Shureban\LaravelSumsubSdk\Dto\Requests\GetApplicantDataRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\Interfaces\ApplicantRequest;
use Shureban\LaravelSumsubSdk\Tests\TestCase;

class GetApplicantDataRequestTest extends TestCase
{
    public function testApplicantIdIsOptional(): void
    {
        $request = new GetApplicantDataRequest('user-42');

        $this->assertInstanceOf(ApplicantRequest::class, $request);
        $this->assertSame('user-42', $request->externalUserId);
        $this->assertNull($request->applicantId);
        $this->assertSame('user-42', $request->getExternalUserId());
        $this->assertNull($request->getApplicantId());
    }

    public function testGettersReturnBothIdentifiers(): void
    {
        $request = new GetApplicantDataRequest('user-42', 'abc123');

        $this->assertSame('abc123', $request->getApplicantId());
        $this->assertSame('user-42', $request->getExternalUserId());
    }

    public function testQueryParamsDropNullApplicantId(): void
    {
        $this->assertSame('externalUserId=user-42', (new GetApplicantDataRequest('user-42'))->queryParams());
        $this->assertSame('externalUserId=user-42&applicantId=abc123', (new GetApplicantDataRequest('user-42', 'abc123'))->queryParams());
    }

    public function testToJsonKeepsNulls(): void
    {
        $request = new GetApplicantDataRequest('user-42');

        $this->assertSame('{"externalUserId":"user-42","applicantId":null}', $request->toJson());
        $this->assertSame(['externalUserId' => 'user-42', 'applicantId' => null], $request->toArray());
    }
}
