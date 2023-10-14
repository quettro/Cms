<?php

namespace App\Macros;

use Closure;
use Illuminate\Database\Query\Builder;

class QueryBuilderMacros
{
    /**
     * @return Closure
     */
    public function whereLike(): Closure
    {
        return function ($column, $value, $boolean = 'and') {
            /* @var Builder $this */

            return $this->where($column, 'like', "%{$value}%", $boolean);
        };
    }
}
