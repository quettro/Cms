<?php

namespace App\Http\Requests\WebVariable;

use App\Models\WebVariable;
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'key' => [
                'required', 'max:255', Rule::unique(WebVariable::class)->where('web_site_id', $this->route('webSite')->id)
            ],
            'name' => [
                'required', 'max:255'
            ],
            'value' => [
                'required', 'max:255'
            ],
        ];
    }
}
