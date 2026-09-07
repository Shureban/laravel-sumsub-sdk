<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit\Attributes;

use Illuminate\Http\Request;
use Shureban\LaravelSumsubSdk\Attributes\PayloadDigest;
use Shureban\LaravelSumsubSdk\Tests\TestCase;

class PayloadDigestTest extends TestCase
{
    public function testDigestIsHmacOfRawRequestBodyWithConfiguredAlgorithm(): void
    {
        $payload = '{"applicantId":"abc","type":"applicantReviewed"}';
        $request = Request::create('/webhooks/sumsub', 'POST', [], [], [], ['CONTENT_TYPE' => 'application/json'], $payload);

        $digest = new PayloadDigest($request, 'webhook-secret');

        $this->assertSame(hash_hmac('sha256', $payload, 'webhook-secret'), (string)$digest);
    }

    public function testDigestRespectsSignatureAlgorithmFromConfig(): void
    {
        config()->set('sumsub.signature_algorithm', 'sha512');

        $payload = '{"applicantId":"abc"}';
        $request = Request::create('/webhooks/sumsub', 'POST', [], [], [], [], $payload);

        $digest = new PayloadDigest($request, 'webhook-secret');

        $this->assertSame(hash_hmac('sha512', $payload, 'webhook-secret'), (string)$digest);
        $this->assertSame(128, strlen((string)$digest));
    }

    public function testDigestMatchesSumsubHeaderVerificationFlow(): void
    {
        $payload  = '{"applicantId":"abc"}';
        $expected = hash_hmac('sha256', $payload, 'webhook-secret');
        $request  = Request::create('/webhooks/sumsub', 'POST', [], [], [], ['HTTP_X_PAYLOAD_DIGEST' => $expected], $payload);

        $this->assertTrue(hash_equals((string)new PayloadDigest($request, 'webhook-secret'), $request->header('x-payload-digest')));
        $this->assertFalse(hash_equals((string)new PayloadDigest($request, 'other-secret'), $request->header('x-payload-digest')));
    }
}
