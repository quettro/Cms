<?php

namespace App\Http\Requests\WebBreadcrumb;

use App\Models\WebBreadcrumb;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'key' => [
                'required', 'max:255', Rule::unique(WebBreadcrumb::class)->where('web_site_id', $this->route('webSite')->id)
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
