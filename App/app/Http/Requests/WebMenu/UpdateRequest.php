<?php

namespace App\Http\Requests\WebMenu;

use App\Models\WebMenu;
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
                'required', 'max:255', Rule::unique(WebMenu::class)->where('web_site_id', $this->route('webSite')->id)->ignore($this->route('webMenu')->id)
            ],
            'name' => [
                'required', 'max:255'
            ],
        ];
    }
}
