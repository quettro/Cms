<?php

namespace App\Http\Requests\ModuleColumn;

use App\Enums\ModuleColumnType;
use App\Models\ModuleColumn;
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
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $merge = $this->input();
        $merge['table'] = $this->boolean('table', 0) ? 1 : 0;
        $merge['required'] = $this->boolean('required', 0) ? 1 : 0;

        $this->merge($merge);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'key' => [
                'required', 'string', 'alpha_num', 'max:255', Rule::unique(ModuleColumn::class)->where('module_id', $this->route('module')->id)
            ],
            'name' => [
                'required', 'string', 'max:255'
            ],
            'table' => [
                'boolean'
            ],
            'required' => [
                'boolean'
            ],
            'type' => [
                'required', new EnumValue(ModuleColumnType::class, false), function ($attribute, $value, $throw) {
                    if (ModuleColumnType::_FILE == $value) {
                        $module = $this->route('module');

                        if ($module->type->is(\App\Enums\ModuleType::GALLERY)) {
                            if ($module->moduleColumns()->where(['type' => ModuleColumnType::_FILE])->count()) {
                                $throw('В модуле типа "Галерея" возможно создать только одну колонку c типом "Файл".');
                            }
                        }
                    }
                }
            ],
        ];
    }
}
