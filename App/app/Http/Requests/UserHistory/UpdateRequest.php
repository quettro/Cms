<?php

namespace App\Http\Requests\UserHistory;

use App\Models\User;
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'message' => [
                'required', 'string', 'max:65535'
            ],
            'user_id' => [
                'required', 'numeric', Rule::exists(User::class, 'id')
            ],
        ];
    }
}
