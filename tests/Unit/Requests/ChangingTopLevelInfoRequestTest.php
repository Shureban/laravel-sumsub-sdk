<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit\Requests;

use Shureban\LaravelSumsubSdk\Dto\Requests\ChangingTopLevelInfoRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\Interfaces\ApplicantRequest;
use Shureban\LaravelSumsubSdk\Enums\ApplicantType;
use Shureban\LaravelSumsubSdk\Tests\TestCase;

class ChangingTopLevelInfoRequestTest extends TestCase
{
    public function testDefaultsAreNull(): void
    {
        $request = new ChangingTopLevelInfoRequest('abc123');

        $this->assertInstanceOf(ApplicantRequest::class, $request);
        $this->assertSame('abc123', $request->id);
        $this->assertSame('abc123', $request->getApplicantId());
        $this->assertNull($request->getExternalUserId());
        $this->assertSame([
            'id'             => 'abc123',
            'externalUserId' => null,
            'email'          => null,
            'phone'          => null,
            'type'           => null,
            'sourceKey'      => null,
            'lang'           => null,
            'questionnaires' => null,
            'metadata'       => null,
            'deleted'        => null,
        ], $request->body());
    }

    public function testBodyReflectsAssignedValues(): void
    {
        $request                 = new ChangingTopLevelInfoRequest('abc123');
        $request->externalUserId = 'user-42';
        $request->email          = 'john@example.com';
        $request->phone          = '+380501234567';
        $request->type           = ApplicantType::Company;
        $request->sourceKey      = 'web';
        $request->lang           = 'uk';
        $request->questionnaires = [['id' => 'q1']];
        $request->metadata       = [['key' => 'plan', 'value' => 'premium']];
        $request->deleted        = false;

        $body = $request->body();

        $this->assertSame('user-42', $request->getExternalUserId());
        $this->assertSame(ApplicantType::Company, $body['type']);
        $this->assertSame('uk', $body['lang']);
        $this->assertFalse($body['deleted']);
        $this->assertSame([['key' => 'plan', 'value' => 'premium']], $body['metadata']);
    }

    public function testJsonEncodedBodySerializesEnumAsValue(): void
    {
        $request       = new ChangingTopLevelInfoRequest('abc123');
        $request->type = ApplicantType::Individual;

        $json = json_decode(json_encode($request->body()), true);

        $this->assertSame('individual', $json['type']);
        $this->assertArrayHasKey('email', $json);
        $this->assertNull($json['email']);
    }
}
