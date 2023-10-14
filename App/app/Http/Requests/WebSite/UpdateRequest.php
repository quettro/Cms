<?php

namespace App\Http\Requests\WebSite;

use App\Models\Language;
use App\Models\WebSite;
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
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $merge = $this->input();
        $merge['enabled'] = $this->boolean('enabled', 0) ? 1 : 0;

        $this->merge($merge);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required', 'max:255'
            ],
            'description' => [
                'required', 'max:255'
            ],
            'language_id' => [
                'required', Rule::exists(Language::class, 'id')
            ],
            'charset' => [
                'required', 'max:255'
            ],
            'dateformat' => [
                'required', 'max:255'
            ],
            'timeformat' => [
                'required', 'max:255'
            ],
            'enabled' => [
                'boolean'
            ],
            'ssl_certificate' => [
                'nullable', 'max:255', function ($attribute, $value, $throw) {
                    if (!empty($value)) {
                        if (!is_file($value)) {
                            $throw('Указанный путь не существует. Исправьте его и повторите попытку.');
                        }
                    }
                }
            ],
            'ssl_certificate_key' => [
                'nullable', 'max:255', function ($attribute, $value, $throw) {
                    if (!empty($value)) {
                        if (!is_file($value)) {
                            $throw('Указанный путь не существует. Исправьте его и повторите попытку.');
                        }
                    }
                }
            ],
        ];
    }
}
