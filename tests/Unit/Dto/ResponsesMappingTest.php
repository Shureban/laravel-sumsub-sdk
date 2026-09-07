<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit\Dto;

use Shureban\LaravelObjectMapper\Exceptions\ParseJsonException;
use Shureban\LaravelObjectMapper\ObjectMapper;
use Shureban\LaravelSumsubSdk\Dto\Responses\AccessToken;
use Shureban\LaravelSumsubSdk\Dto\Responses\OkResponse;
use Shureban\LaravelSumsubSdk\Tests\TestCase;

class ResponsesMappingTest extends TestCase
{
    public function testAccessToken(): void
    {
        $token = (new ObjectMapper(new AccessToken()))->mapFromJson($this->fixture('access_token.json'));

        $this->assertSame('_act-sbx-a1b2c3d4-e5f6-7890-abcd-ef1234567890', $token->token);
        $this->assertSame('user-42', $token->userId);
    }

    public function testOkResponse(): void
    {
        $response = (new ObjectMapper(new OkResponse()))->mapFromJson($this->fixture('ok.json'));

        $this->assertSame(1, $response->ok);
    }

    public function testOkResponseCastsStringToInt(): void
    {
        $response = (new ObjectMapper(new OkResponse()))->mapFromJson('{"ok":"1"}');

        $this->assertSame(1, $response->ok);
    }

    public function testInvalidJsonThrowsParseJsonException(): void
    {
        $this->expectException(ParseJsonException::class);

        (new ObjectMapper(new OkResponse()))->mapFromJson('{"ok":');
    }
}
