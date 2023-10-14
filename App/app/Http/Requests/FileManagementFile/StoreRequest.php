<?php

namespace App\Http\Requests\FileManagementFile;

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
            'file' => [
                'required', 'file'
            ],
        ];
    }
}
