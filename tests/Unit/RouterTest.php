<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit;

use Shureban\LaravelSumsubSdk\Router;
use Shureban\LaravelSumsubSdk\Tests\TestCase;

class RouterTest extends TestCase
{
    private Router $router;

    protected function setUp(): void
    {
        parent::setUp();

        $this->router = new Router();
    }

    public function testCreateApplicant(): void
    {
        $this->assertSame('/resources/applicants', $this->router->createApplicant());
    }

    public function testChangingTopLevelInfo(): void
    {
        $this->assertSame('/resources/applicants', $this->router->changingTopLevelInfo());
    }

    public function testCreateAccessToken(): void
    {
        $this->assertSame('/resources/accessTokens', $this->router->createAccessToken());
    }

    public function testGetApplicantDataByApplicantId(): void
    {
        $this->assertSame('/resources/applicants/abc123/one', $this->router->getApplicantDataByApplicantId('abc123'));
    }

    public function testResetApplicant(): void
    {
        $this->assertSame('/resources/applicants/abc123/reset', $this->router->resetApplicant('abc123'));
    }

    public function testGetApplicantDataByExternalUserId(): void
    {
        $this->assertSame('/resources/applicants/-;externalUserId=user-42/one', $this->router->getApplicantDataByExternalUserId('user-42'));
    }
}
