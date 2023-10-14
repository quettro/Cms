<?php

namespace App\Filters;

class UserHistoryQueryFilter extends QueryFilter
{
    /**
     * @param $value
     * @return void
     */
    public function byMessage($value): void
    {
        $this->builder->whereLike('message', $value);
    }

    /**
     * @param $value
     * @return void
     */
    public function byUserId($value): void
    {
        if ($value === null) {
            return;
        }
        $this->builder->where('user_id', $value);
    }
}
