<?php

namespace App\Http\Requests\WebPageTemplate;

use App\Models\WebPageTemplateLanguage;
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
            'webpagetemplate.name' => [
                'required', 'max:255'
            ],
            'webpagetemplatelanguageversion.blade' => [
                'nullable', 'max:16777215'
            ],
            'web_page_template_language_id' => [
                'required', 'numeric', Rule::exists(WebPageTemplateLanguage::class, 'id')->where('web_page_template_id', $this->route('webPageTemplate')->id)
            ],
        ];
    }
}
