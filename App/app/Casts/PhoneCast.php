<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PhoneCast implements CastsAttributes
{
    /**
     * @param $model
     * @param string $key
     * @param $value
     * @param array $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes): mixed
    {
        return $value;
    }

    /**
     * @param $value
     * @return array|string|string[]|null
     */
    public function formatted($value): array|string|null
    {
        if (!$value) {
            return '-';
        }
        return preg_replace('/^7([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})$/', '+7 ($1) $2 $3-$4', $value);
    }

    /**
     * @param $model
     * @param string $key
     * @param $value
     * @param array $attributes
     * @return object
     */
    public function get($model, string $key, $value, array $attributes): object
    {
        return (object) ['value' => $value, 'formatted' => $this->formatted($value)];
    }
}
