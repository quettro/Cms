<?php

namespace App\Http\Requests\Block;

use App\Models\Block;
use App\Models\BlockLanguage;
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
            'block.key' => [
                'required', 'max:255', Rule::unique(Block::class, 'key')->ignore($this->route('block'))
            ],
            'block.name' => [
                'required', 'max:255'
            ],
            'blocklanguageversion.blade' => [
                'nullable', 'max:65535'
            ],
            'block_language_id' => [
                'required', 'numeric', Rule::exists(BlockLanguage::class, 'id')
            ],
        ];
    }
}
