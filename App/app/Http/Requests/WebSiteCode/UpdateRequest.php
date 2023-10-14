<?php

namespace App\Http\Requests\WebSiteCode;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'head' => [
                'nullable', 'max:65535'
            ],
            'body' => [
                'nullable', 'max:65535'
            ],
        ];
    }
}
