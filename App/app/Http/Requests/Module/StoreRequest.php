<?php

namespace App\Http\Requests\Module;

use App\Enums\ModuleType;
use App\Models\Module;
use App\Models\WebPage;
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
        $merge['route'] = WebPage::clearTheRouteOfExtraCharacters($this->input('route'));
        $merge['child_route'] = WebPage::clearTheRouteOfExtraCharacters($this->input('child_route'));

        $this->merge($merge);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'key' => [
                'required', 'string', 'alpha_num', 'max:255', Rule::unique(Module::class)
            ],
            'name' => [
                'required', 'string', 'max:255'
            ],
            'dateformat' => [
                'required', 'max:255'
            ],
            'timeformat' => [
                'required', 'max:255'
            ],
            'type' => [
                'required', new EnumValue(ModuleType::class, false)
            ],
            'route' => [
                'required_if:type,' . ModuleType::INDIVIDUAL, 'max:255', Rule::unique(Module::class)
            ],
            'child_route' => [
                'required_if:type,' . ModuleType::INDIVIDUAL, 'max:255', 'regex:/^' . WebPage::$regexTheRouteForValidation . '$/'
            ],
        ];
    }
}
