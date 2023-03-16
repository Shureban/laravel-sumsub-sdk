<?php

namespace Shureban\LaravelSumsubSdk\Dto\Requests;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class SumsubRequest implements Arrayable, Jsonable
{
    /**
     * @return string
     */
    public function queryParams(): string
    {
        return http_build_query($this->toArray());
    }

    /**
     * @return array
     */
    public function body(): array
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @param int $options
     *
     * @return string
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }
}