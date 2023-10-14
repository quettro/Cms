<?php

namespace App\Http\Requests\WebBlock;

use App\Models\WebBlock;
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
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'webblock.key' => [
                'required', 'max:255', Rule::unique(WebBlock::class, 'key')->where('web_site_id', $this->route('webSite')->id)
            ],
            'webblock.name' => [
                'required', 'max:255'
            ],
            'webblocklanguageversion.blade' => [
                'nullable', 'max:65535'
            ],
        ];
    }
}
