<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class AddressesCast implements CastsAttributes
{
    /**
     * @param $model
     * @param string $key
     * @param $value
     * @param array $attributes
     * @return array
     */
    public function get($model, string $key, $value, array $attributes): array
    {
        try {
            return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
        }
        catch (\Exception $exception) {
            return [];
        }
    }

    /**
     * @param $model
     * @param string $key
     * @param $value
     * @param array $attributes
     * @return string|bool
     */
    public function set($model, string $key, $value, array $attributes): string|bool
    {
        $value = is_array($value) ? $value : explode(',', $value);
        $value = array_map('trim', (array) array_filter($value));

        return json_encode(array_unique($value));
    }
}
