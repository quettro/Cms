<?php

namespace App\Http\Requests\WebBlock;

use App\Models\WebBlock;
use App\Models\WebBlockLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'webblock.key' => [
                'required', 'max:255', Rule::unique(WebBlock::class, 'key')->where('web_site_id', $this->route('webSite')->id)->ignore($this->route('webBlock'))
            ],
            'webblock.name' => [
                'required', 'max:255'
            ],
            'webblocklanguageversion.blade' => [
                'nullable', 'max:65535'
            ],
            'web_block_language_id' => [
                'required', 'numeric', Rule::exists(WebBlockLanguage::class, 'id')
            ],
        ];
    }
}
