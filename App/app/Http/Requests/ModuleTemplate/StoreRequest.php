<?php

namespace App\Http\Requests\ModuleTemplate;

use App\Enums\ModuleTemplateOrderBy;
use App\Models\ModuleColumn;
use App\Models\ModuleTemplate;
use BenSampo\Enum\Rules\EnumValue;
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
                'required', 'string', 'alpha_num', 'max:255', Rule::unique(ModuleTemplate::class, 'key')->where('module_id', $this->route('module')->id)
            ],
            'name' => [
                'required', 'string', 'max:255'
            ],
            'count' => [
                'required', 'numeric'
            ],
            'order_by_column' => [
                'nullable', 'numeric', Rule::exists(ModuleColumn::class, 'id')
            ],
            'order_by' => [
                'nullable', new EnumValue(ModuleTemplateOrderBy::class, false)
            ],
            'blade' => [
                'nullable', 'max:65535'
            ],
        ];
    }
}
