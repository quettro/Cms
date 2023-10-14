<?php

namespace App\Http\Requests\WebPage;

use App\Models\WebPage;
use App\Models\WebPageTemplate;
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
        $merge['webpage']['route'] = WebPage::clearTheRouteOfExtraCharacters($this->input('webpage.route', ''));
        $merge['webpagelanguage']['is_home'] = $this->boolean('webpagelanguage.is_home', 0) ? 1 : 0;
        $merge['webpagelanguage']['is_enabled'] = $this->boolean('webpagelanguage.is_enabled', 0) ? 1 : 0;

        $this->merge($merge);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'webpage.name' => [
                'required', 'max:255'
            ],
            'webpage.route' => [
                'required', 'max:255', 'regex:/^' . WebPage::$regexTheRouteForValidation . '$/', Rule::unique(WebPage::class, 'route')->where('web_site_id', $this->route('webSite')->id)->where('parent_id', $this->input('webpage.parent_id'))
            ],
            'webpage.parent_id' => [
                'nullable', 'numeric', Rule::exists(WebPage::class, 'id')->where('web_site_id', $this->route('webSite')->id)
            ],

            'webpagelanguage.web_page_template_id' => [
                'nullable', 'numeric', Rule::exists(WebPageTemplate::class, 'id')->where('web_site_id', $this->route('webSite')->id)
            ],
            'webpagelanguage.title' => [
                'nullable', 'max:255'
            ],
            'webpagelanguage.description' => [
                'nullable', 'max:255'
            ],
            'webpagelanguage.keywords' => [
                'nullable', 'max:255'
            ],
            'webpagelanguage.og_title' => [
                'nullable', 'max:255'
            ],
            'webpagelanguage.og_description' => [
                'nullable', 'max:255'
            ],
            'webpagelanguage.og_image' => [
                'nullable', 'file', 'image', 'mimes:jpeg,jpg,png'
            ],
            'webpagelanguage.name_of_the_crumb' => [
                'nullable', 'max:255'
            ],
            'webpagelanguage.redirect' => [
                'nullable', 'max:255'
            ],
            'webpagelanguage.is_home' => [
                'boolean'
            ],
            'webpagelanguage.is_enabled' => [
                'boolean'
            ],

            'webpagelanguageversion.additional_head' => [
                'nullable', 'max:65535'
            ],
            'webpagelanguageversion.additional_body' => [
                'nullable', 'max:65535'
            ],
            'webpagelanguageversion.blade' => [
                'nullable', 'max:16777215'
            ],
        ];
    }
}
