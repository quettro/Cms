<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Models\WebSite;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

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
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($this->route('user')->id)
            ],
            'password' => [
                'sometimes', 'nullable', Rules\Password::defaults()
            ],
            'name' => [
                'required', 'string', 'max:255'
            ],
            'phone' => [
                'nullable', 'string', 'regex:/^7([0-9]+){10}$/'
            ],
            'description' => [
                'nullable', 'string', 'max:255'
            ],
            'websites' => [
                'nullable'
            ],
            'websites.*' => [
                'numeric', Rule::exists(WebSite::class, 'id')
            ],
        ];
    }
}
