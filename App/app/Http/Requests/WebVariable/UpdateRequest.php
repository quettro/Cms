<?php

namespace App\Http\Requests\WebVariable;

use App\Models\WebVariable;
use App\Models\WebVariableLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'key' => [
                'required', 'max:255', Rule::unique(WebVariable::class)->where('web_site_id', $this->route('webSite')->id)->ignore($this->route('webVariable')->id)
            ],
            'name' => [
                'required', 'max:255'
            ],
            'value' => [
                'required', 'max:255'
            ],
            'web_variable_language_id' => [
                'required', 'numeric', Rule::exists(WebVariableLanguage::class, 'id')->where('web_variable_id', $this->route('webVariable')->id)
            ],
        ];
    }
}
