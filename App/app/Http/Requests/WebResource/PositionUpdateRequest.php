<?php

namespace App\Http\Requests\WebResource;

use App\Models\WebResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PositionUpdateRequest extends FormRequest
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
            'order' => [
                'required', 'array'
            ],
            'order.*' => [
                'required'
            ],
            'order.*.id' => [
                'required', 'numeric', Rule::exists(WebResource::class, 'id')->where('web_site_id', $this->route('webSite')->id)
            ],
            'order.*.index' => [
                'required', 'numeric'
            ],
        ];
    }
}
