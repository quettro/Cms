<?php

namespace App\Collections;

class Collection extends \Illuminate\Database\Eloquent\Collection
{
    /**
     * @param null $k
     * @param null $v
     * @return Collection|\Illuminate\Support\Collection
     */
    public function dropdown($k = null, $v = null): Collection|\Illuminate\Support\Collection
    {
        $k = $k !== null ? $k : static fn ($value, $key) => $value->id;
        $v = $v !== null ? $v : static fn ($value, $key) => $value->id;

        return $this->mapWithKeys(static fn ($value, $key) => [$k($value, $key) => $v($value, $key)]);
    }
}
