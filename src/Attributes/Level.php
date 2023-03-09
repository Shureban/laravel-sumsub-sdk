<?php

namespace Shureban\LaravelSumsubSdk\Attributes;

use Stringable;

class Level implements Stringable
{
    private string $levelName;

    /**
     * @param string $levelName
     */
    public function __construct(string $levelName)
    {
        $this->levelName = $levelName;
    }

    public function __toString(): string
    {
        return $this->levelName;
    }
}