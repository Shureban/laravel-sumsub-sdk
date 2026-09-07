<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit\Dto;

use DateTime;
use Shureban\LaravelObjectMapper\ObjectMapper;
use Shureban\LaravelSumsubSdk\Attributes\Level;
use Shureban\LaravelSumsubSdk\Dto\Webhooks\CreatedApplicant;
use Shureban\LaravelSumsubSdk\Enums\ApplicantType;
use Shureban\LaravelSumsubSdk\Enums\ReviewStatus;
use Shureban\LaravelSumsubSdk\Tests\TestCase;

class CreatedApplicantWebhookMappingTest extends TestCase
{
    public function testWebhookPayloadIsMapped(): void
    {
        $webhook = (new ObjectMapper(new CreatedApplicant()))->mapFromJson($this->fixture('webhook_applicant_created.json'));

        $this->assertSame('5cb744200a975a67ed1798a4', $webhook->applicantId);
        $this->assertSame('5cb744200a975a67ed1798a5', $webhook->inspectionId);
        $this->assertSame(ApplicantType::Individual, $webhook->applicantType);
        $this->assertSame('req-63f92830-4d68-4eee-98d5-875d53a12258', $webhook->correlationId);
        $this->assertInstanceOf(Level::class, $webhook->levelName);
        $this->assertSame('basic-kyc-level', (string)$webhook->levelName);
        $this->assertFalse($webhook->sandboxMode);
        $this->assertSame('12672', $webhook->externalUserId);
        $this->assertSame('applicantCreated', $webhook->type);
        $this->assertSame(ReviewStatus::Init, $webhook->reviewStatus);
        $this->assertSame('coolClientId', $webhook->clientId);
    }

    public function testDatesAreParsedWithMilliseconds(): void
    {
        $webhook = (new ObjectMapper(new CreatedApplicant()))->mapFromJson($this->fixture('webhook_applicant_created.json'));

        $this->assertInstanceOf(DateTime::class, $webhook->createdAt);
        $this->assertSame('2020-02-21 13:23:19', $webhook->createdAt->format('Y-m-d H:i:s'));
        $this->assertSame('+00:00', $webhook->createdAt->format('P'));

        $this->assertInstanceOf(DateTime::class, $webhook->createdAtMs);
        $this->assertSame('2020-02-21 13:23:19.001', $webhook->createdAtMs->format('Y-m-d H:i:s.v'));
    }

    public function testSandboxModeAcceptsTruthyValues(): void
    {
        $webhook = (new ObjectMapper(new CreatedApplicant()))->mapFromArray(['sandboxMode' => true]);

        $this->assertTrue($webhook->sandboxMode);
    }
}
