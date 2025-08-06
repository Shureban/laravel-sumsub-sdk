<?php

namespace Shureban\LaravelSumsubSdk\Attributes;

use Stringable;

class Signature implements Stringable
{
    private string $url;
    private int    $time;
    private string $httpMethod;
    private string $body;
    private string $secretKey;

    /**
     * @param string $secretKey
     * @param string $url
     * @param int    $time
     * @param string $httpMethod
     * @param string $body
     */
    public function __construct(string $secretKey, string $url, int $time, string $httpMethod, string $body = '')
    {
        $this->secretKey  = $secretKey;
        $this->url        = $url;
        $this->time       = $time;
        $this->httpMethod = $httpMethod;
        $this->body       = $body;
    }

    public function __toString(): string
    {
        $data = sprintf('%s%s%s%s', $this->time, strtoupper($this->httpMethod), $this->url, $this->body);

        return hash_hmac('sha256', $data, $this->secretKey);
    }
}