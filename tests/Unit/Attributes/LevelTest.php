<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit\Attributes;

use Shureban\LaravelSumsubSdk\Attributes\Level;
use Shureban\LaravelSumsubSdk\Tests\TestCase;
use Stringable;

class LevelTest extends TestCase
{
    public function testCastsToLevelName(): void
    {
        $level = new Level('basic-kyc-level');

        $this->assertInstanceOf(Stringable::class, $level);
        $this->assertSame('basic-kyc-level', (string)$level);
        $this->assertSame('basic-kyc-level', $level->__toString());
    }

    public function testConfigExposesLevelsPerApplicantType(): void
    {
        $this->assertInstanceOf(Level::class, config('sumsub.individual'));
        $this->assertInstanceOf(Level::class, config('sumsub.company'));
        $this->assertSame(self::KYC_LEVEL, (string)config('sumsub.individual'));
        $this->assertSame(self::KYB_LEVEL, (string)config('sumsub.company'));
    }
}
