<?php

namespace App\Http\Requests\WebMenuItem;

use App\Models\WebMenuItem;
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
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $merge = $this->input();
        $merge['webmenuitemlanguage']['is_enabled'] = $this->boolean('webmenuitemlanguage.is_enabled', 0) ? 1 : 0;

        $this->merge($merge);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'webmenuitemlanguage.name' => [
                'required', 'max:255'
            ],
            'webmenuitemlanguage.route' => [
                'required', 'max:255'
            ],
            'webmenuitemlanguage.is_enabled' => [
                'boolean'
            ],
            'webmenuitem.parent_id' => [
                'nullable', 'numeric', Rule::exists(WebMenuItem::class, 'id')->where('web_menu_id', $this->route('webMenu')->id)
            ],
            'webmenuitemlanguage.blade' => [
                'nullable', 'max:65535'
            ],
        ];
    }
}
