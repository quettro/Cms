<?php

namespace App\Http\Requests\Language;

use App\Models\Language;
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
            'codename' => [
                'required', 'alpha', 'max:255', Rule::unique(Language::class)
            ],
            'name' => [
                'required', 'max:255'
            ],
        ];
    }
}
