<?php

namespace App\Http\Requests\WebMenuTemplate;

use App\Models\WebMenuTemplate;
use App\Models\WebMenuTemplateLanguage;
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
            'webMenuTemplate.key' => [
                'required', 'max:255', Rule::unique(WebMenuTemplate::class, 'key')->where('web_menu_id', $this->route('webMenu')->id)->ignore($this->route('webMenuTemplate'))
            ],
            'webMenuTemplate.name' => [
                'required', 'max:255'
            ],
            'webMenuTemplateLanguage.blade' => [
                'nullable', 'max:65535'
            ],
            'webMenuTemplateLanguage.blade_for_recursive' => [
                'nullable', 'max:65535'
            ],
            'web_menu_template_language_id' => [
                'required', 'numeric', Rule::exists(WebMenuTemplateLanguage::class, 'id')
            ],
        ];
    }
}
