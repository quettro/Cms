<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class QueryFilter
{
    /**
     * @var Builder
     */
    protected Builder $builder;

    /**
     * @param Request $request
     */
    public function __construct(protected Request $request)
    {
    }

    /**
     * @return Collection
     */
    public function query(): Collection
    {
        return collect($this->request->query());
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function applyBuilder(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->query() as $name => $value) {
            $method = str($name)->studly()->prepend('by')->value();

            if (method_exists($this, $method))
                call_user_func_array([$this, $method], [$value]);
        }

        return $this->builder;
    }
}
