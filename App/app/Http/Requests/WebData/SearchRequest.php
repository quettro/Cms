<?php

namespace App\Http\Requests\WebData;

use App\Models\Form;
use App\Models\WebSite;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
{
    /**
     * @return true
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
            'search' => [
                'nullable', 'string', 'max:255'
            ],
            'form_id' => [
                'nullable', 'numeric', Rule::exists(Form::class, 'id')
            ],
            'web_site_id' => [
                'nullable', 'numeric', Rule::exists(WebSite::class, 'id')
            ],
        ];
    }
}
