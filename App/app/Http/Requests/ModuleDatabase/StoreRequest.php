<?php

namespace App\Http\Requests\ModuleDatabase;

use App\Models\WebSite;
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
        return $this->default() + $this->dynamic();
    }

    /**
     * @return array
     */
    protected function default(): array
    {
        $array = [
            'default.websites' => [
                'nullable'
            ],
            'default.websites.*' => [
                'numeric', Rule::exists(WebSite::class, 'id')
            ],
        ];

        if($this->route('module')->type->is(\App\Enums\ModuleType::INDIVIDUAL))
        {
            $array['default.seo_title'] = [
                'required', 'max:255'
            ];

            $array['default.seo_description'] = [
                'nullable', 'max:255'
            ];

            $array['default.seo_keywords'] = [
                'nullable', 'max:255'
            ];

            $array['default.seo_route'] = [
                'nullable', 'alpha_dash', 'max:255'
            ];

            $array['default.og_title'] = [
                'nullable', 'max:255'
            ];

            $array['default.og_description'] = [
                'nullable', 'max:255'
            ];

            $array['default.og_image'] = [
                'nullable', 'exclude', 'file', 'image', 'mimes:jpeg,jpg,png'
            ];

            $array['default.name_of_the_crumb'] = [
                'nullable', 'max:255'
            ];
        }

        return $array;
    }

    /**
     * @return array
     */
    protected function dynamic(): array
    {
        $module = $this->route('module');
        $moduleColumns = $module->moduleColumns;

        foreach($moduleColumns as $moduleColumn)
        {
            $key = 'columns.' . $moduleColumn->key;

            $array[$key] = $moduleColumn->required ? ['required'] : ['nullable'];

            if($moduleColumn->isTypeString()) {
                array_push($array[$key], 'string', 'max:255');
            }

            if($moduleColumn->isTypeText()) {
                array_push($array[$key], 'string', 'max:32768');
            }

            if($moduleColumn->isTypeInteger()) {
                $array[$key][] = 'integer';
            }

            if($moduleColumn->isTypeDate()) {
                $array[$key][] = 'date';
            }

            if($moduleColumn->isTypeDateTime()) {
                $array[$key][] = 'date';
            }

            if($moduleColumn->isTypeTime()) {
                $array[$key][] = 'date_format:H:i';
            }

            if($moduleColumn->isTypeCodeMirror()) {
                array_push($array[$key], 'string', 'max:65535');
            }

            if($moduleColumn->isTypeYoutube()) {
                array_push($array[$key], 'string', 'max:255');
            }

            if($moduleColumn->isTypeFile()) {
                if ($module->type->is(\App\Enums\ModuleType::GALLERY)) {
                    $array[$key . '.*'][] = 'file';
                }
                else {
                    $array[$key][] = 'file';
                }
            }
        }

        return $array ?? [];
    }
}
