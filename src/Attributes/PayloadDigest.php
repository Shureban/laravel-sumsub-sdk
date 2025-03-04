<?php

namespace Shureban\LaravelSumsubSdk\Attributes;

use Illuminate\Http\Request;
use Stringable;

class PayloadDigest implements Stringable
{
    private Request $request;
    private string  $webhookSecretToken;

    /**
     * @param Request $request
     * @param string  $webhookSecretToken
     */
    public function __construct(Request $request, string $webhookSecretToken)
    {
        $this->request            = $request;
        $this->webhookSecretToken = $webhookSecretToken;
    }

    public function __toString(): string
    {
        return hash_hmac(config('sumsub.signature_algorithm'), $this->request->getContent(), $this->webhookSecretToken);
    }
}