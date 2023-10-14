<?php

namespace App\Http\Requests\WebPagination;

use App\Models\WebPagination;
use App\Models\WebPaginationLanguage;
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
            'webPagination.key' => [
                'required', 'max:255', Rule::unique(WebPagination::class, 'key')->where('web_site_id', $this->route('webSite')->id)->ignore($this->route('webPagination')->id)
            ],
            'webPagination.name' => [
                'required', 'max:255'
            ],
            'webPaginationLanguage.blade' => [
                'nullable', 'max:65535'
            ],
            'web_pagination_language_id' => [
                'required', 'numeric', Rule::exists(WebPaginationLanguage::class, 'id')
            ],
        ];
    }
}
