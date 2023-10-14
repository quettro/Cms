<?php

namespace App\Http\Requests\WebPageTemplate;

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
            'webpagetemplate.name' => [
                'required', 'max:255'
            ],
            'webpagetemplatelanguageversion.blade' => [
                'nullable', 'max:16777215'
            ],
        ];
    }
}
