<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit;

use RuntimeException;
use Shureban\LaravelSumsubSdk\Dto\Requests\GetApplicantDataRequest;
use Shureban\LaravelSumsubSdk\Dto\Requests\ResetApplicantRequest;
use Shureban\LaravelSumsubSdk\Exceptions\ApplicantNotFoundException;
use Shureban\LaravelSumsubSdk\Tests\TestCase;

class ApplicantNotFoundExceptionTest extends TestCase
{
    public function testMessageContainsBothIdentifiers(): void
    {
        $exception = new ApplicantNotFoundException(new GetApplicantDataRequest('user-42', 'abc123'));

        $this->assertSame('Applicant not found. ApplicantId: abc123. ExternalUserId: user-42', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }

    public function testMissingIdentifiersAreRenderedEmpty(): void
    {
        $exception = new ApplicantNotFoundException(new ResetApplicantRequest('abc123'));

        $this->assertSame('Applicant not found. ApplicantId: abc123. ExternalUserId: ', $exception->getMessage());
    }

    public function testCodeAndPreviousArePreserved(): void
    {
        $previous  = new RuntimeException('boom');
        $exception = new ApplicantNotFoundException(new GetApplicantDataRequest('user-42'), 404, $previous);

        $this->assertSame(404, $exception->getCode());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
