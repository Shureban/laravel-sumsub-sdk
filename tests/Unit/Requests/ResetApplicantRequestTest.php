<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit\Requests;

use Shureban\LaravelSumsubSdk\Dto\Requests\Interfaces\ApplicantRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\ResetApplicantRequest;
use Shureban\LaravelSumsubSdk\Tests\TestCase;

class ResetApplicantRequestTest extends TestCase
{
    public function testGetters(): void
    {
        $request = new ResetApplicantRequest('abc123');

        $this->assertInstanceOf(ApplicantRequest::class, $request);
        $this->assertSame('abc123', $request->applicantId);
        $this->assertSame('abc123', $request->getApplicantId());
        $this->assertNull($request->getExternalUserId());
    }

    public function testInheritedSerializationFromSumsubRequest(): void
    {
        $request = new ResetApplicantRequest('abc123');

        $this->assertSame(['applicantId' => 'abc123'], $request->toArray());
        $this->assertSame(['applicantId' => 'abc123'], $request->body());
        $this->assertSame('applicantId=abc123', $request->queryParams());
        $this->assertSame('{"applicantId":"abc123"}', $request->toJson());
        $this->assertSame("{\n    \"applicantId\": \"abc123\"\n}", $request->toJson(JSON_PRETTY_PRINT));
    }
}
