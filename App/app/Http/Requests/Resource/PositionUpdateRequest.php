<?php

namespace App\Http\Requests\Resource;

use App\Models\Resource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PositionUpdateRequest extends FormRequest
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
            'order' => [
                'required', 'array'
            ],
            'order.*' => [
                'required'
            ],
            'order.*.id' => [
                'required', 'numeric', Rule::exists(Resource::class, 'id')
            ],
            'order.*.index' => [
                'required', 'numeric'
            ],
        ];
    }
}
