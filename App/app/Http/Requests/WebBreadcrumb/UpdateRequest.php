<?php

namespace App\Http\Requests\WebBreadcrumb;

use App\Models\WebBreadcrumb;
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
                'required', 'max:255', Rule::unique(WebBreadcrumb::class)->where('web_site_id', $this->route('webSite')->id)->ignore($this->route('webBreadcrumb')->id)
            ],
            'name' => [
                'required', 'max:255'
            ],
            'blade' => [
                'nullable', 'max:65535'
            ],
        ];
    }
}
