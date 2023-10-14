<?php

namespace App\Http\Requests\Input;

use App\Models\Input;
use App\Models\InputLanguage;
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
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $merge = $this->input();
        $merge['input']['v_required'] = $this->boolean('input.v_required', 0) ? 1 : 0;
        $merge['input']['v_alpha'] = $this->boolean('input.v_alpha', 0) ? 1 : 0;
        $merge['input']['v_alpha_dash'] = $this->boolean('input.v_alpha_dash', 0) ? 1 : 0;
        $merge['input']['v_alpha_num'] = $this->boolean('input.v_alpha_num', 0) ? 1 : 0;
        $merge['input']['v_string'] = $this->boolean('input.v_string', 0) ? 1 : 0;
        $merge['input']['v_numeric'] = $this->boolean('input.v_numeric', 0) ? 1 : 0;
        $merge['input']['v_email'] = $this->boolean('input.v_email', 0) ? 1 : 0;
        $merge['input']['v_boolean'] = $this->boolean('input.v_boolean', 0) ? 1 : 0;
        $merge['input']['v_accepted'] = $this->boolean('input.v_accepted', 0) ? 1 : 0;
        $merge['input']['v_ip'] = $this->boolean('input.v_ip', 0) ? 1 : 0;

        $this->merge($merge);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'input.key' => [
                'required', 'max:255', Rule::unique(Input::class, 'key')->ignore($this->route('input')->id)
            ],
            'input.name' => [
                'required', 'max:255'
            ],
            'input.v_regex' => [
                'nullable', 'max:255'
            ],
            'input.v_not_regex' => [
                'nullable', 'max:255'
            ],
            'input.v_required' => [
                'boolean'
            ],
            'input.v_alpha' => [
                'boolean'
            ],
            'input.v_alpha_dash' => [
                'boolean'
            ],
            'input.v_alpha_num' => [
                'boolean'
            ],
            'input.v_string' => [
                'boolean'
            ],
            'input.v_numeric' => [
                'boolean'
            ],
            'input.v_email' => [
                'boolean'
            ],
            'input.v_boolean' => [
                'boolean'
            ],
            'input.v_accepted' => [
                'boolean'
            ],
            'input.v_ip' => [
                'boolean'
            ],
            'inputLanguage.blade' => [
                'nullable', 'max:65535'
            ],
            'input_language_id' => [
                'required', 'numeric', Rule::exists(InputLanguage::class, 'id')
            ],
        ];
    }
}
