<?php

namespace App\Http\Requests\FileManagementDir;

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
            'path' => [
                'nullable'
            ],
            'name' => [
                'required', 'max:255'
            ],
        ];
    }
}
