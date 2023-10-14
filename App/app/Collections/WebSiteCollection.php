<?php

namespace App\Collections;

class WebSiteCollection extends Collection
{
    /**
     * @param null $k
     * @param null $v
     * @return Collection|\Illuminate\Support\Collection
     */
    public function dropdown($k = null, $v = null): Collection|\Illuminate\Support\Collection
    {
        $v = $v !== null ? $v : static fn ($value, $key) => $value->domain;

        return parent::dropdown($k, $v);
    }
}
