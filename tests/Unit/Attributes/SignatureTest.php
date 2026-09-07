<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit\Attributes;

use Shureban\LaravelSumsubSdk\Attributes\Signature;
use Shureban\LaravelSumsubSdk\Tests\TestCase;

class SignatureTest extends TestCase
{
    public function testSignatureWithoutBody(): void
    {
        $signature = new Signature('secret-key', '/resources/accessTokens?ttlInSecs=600&userId=user-42&levelName=basic-kyc-level', 1700000000, 'POST');

        $this->assertSame('320dfe03677e0ee3192179a203a805d1bf55ededac8b2cb44f7f98f26d80d8df', (string)$signature);
    }

    public function testSignatureWithBody(): void
    {
        $signature = new Signature('secret-key', '/resources/applicants?levelName=basic-kyc-level', 1700000000, 'POST', '{"externalUserId":"user-42"}');

        $this->assertSame('e5e1fedb9db6c67d97144c599bf17d2b541886eae90a4b11a9c1eb4fea700d46', (string)$signature);
    }

    public function testSignatureIsHmacSha256OfTimeMethodUrlAndBody(): void
    {
        $signature = new Signature('s3cret', '/path?x=1', 1234567890, 'PATCH', '{"a":1}');
        $expected  = hash_hmac('sha256', '1234567890PATCH/path?x=1{"a":1}', 's3cret');

        $this->assertSame($expected, (string)$signature);
    }

    public function testHttpMethodIsUpperCased(): void
    {
        $lower = new Signature('secret-key', '/path', 1700000000, 'get');
        $upper = new Signature('secret-key', '/path', 1700000000, 'GET');

        $this->assertSame((string)$upper, (string)$lower);
    }

    public function testDifferentSecretsProduceDifferentSignatures(): void
    {
        $first  = new Signature('secret-a', '/path', 1700000000, 'GET');
        $second = new Signature('secret-b', '/path', 1700000000, 'GET');

        $this->assertNotSame((string)$first, (string)$second);
    }
}
