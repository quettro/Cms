<?php

namespace App\Http\Requests\Resource;

use App\Enums\ResourcePosition;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'position' => [
                'required', new EnumValue(ResourcePosition::class, false)
            ],
            'file' => [
                'required', 'max:100'
            ],
            'file.*' => [
                'file'
            ],
        ];
    }
}
