<?php

namespace App\Http\Requests\Form;

use App\Models\Form;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'form.key' => [
                'required', 'max:255', Rule::unique(Form::class, 'key')
            ],
            'form.redirect' => [
                'nullable', 'max:255'
            ],
            'form.addresses' => [
                'nullable'
            ],
            'formLanguage.blade' => [
                'nullable', 'max:65535'
            ],
        ];
    }
}
