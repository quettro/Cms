<?php

namespace App\Http\Requests\Constructor;

use App\Models\Form;
use App\Models\Input;
use Illuminate\Foundation\Http\FormRequest;

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
        if ($this->has('_f')) {
            $form = Form::where(['key' => $this->input('_f')])->first();

            if ($form) {
                foreach (Input::query()->get() as $input) {
                    if ($this->has($input->key)) {
                        $array[$input->key] = $input->rules();
                    }
                }
            }
        }
        return $array ?? [];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        if ($this->has('_f')) {
            $form = Form::where(['key' => $this->input('_f')])->first();

            if ($form) {
                foreach (Input::query()->get() as $input) {
                    if ($this->has($input->key)) {
                        $array[$input->key] = $input->name;
                    }
                }
            }
        }
        return $array ?? [];
    }
}
