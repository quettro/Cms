<?php

namespace App\Http\Requests\WebPageCopy;

use App\Models\WebPage;
use App\Models\WebPageTemplate;
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
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $route = $this->input('webpage')['route'] ?? '';
        $route = WebPage::clearTheRouteOfExtraCharacters($route);

        $merge = [];
        $merge['webpage']['route'] = $route;
        $merge['webpage']['is_home'] = $this->boolean('webpage.is_home', 0) ? 1 : 0;
        $merge['webpage']['is_enabled'] = $this->boolean('webpage.is_enabled', 0) ? 1 : 0;

        $this->merge($merge);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'webpage.web_site_id' => [
                'required', 'numeric', Rule::exists(WebSite::class, 'id')
            ],
            'webpage.name' => [
                'required', 'max:255'
            ],
            'webpage.route' => [
                'required', 'max:255', 'regex:' . WebPage::$regexTheRouteForValidation, Rule::unique(WebPage::class, 'route')->where('web_site_id', $this->input('webpage')['web_site_id'] ?? NULL)->where('parent_id', $this->input('webpage')['parent_id'] ?? NULL)
            ],
            'webpage.parent_id' => [
                'nullable', 'numeric', Rule::exists(WebPage::class, 'id')->where('web_site_id', $this->input('webpage')['web_site_id'] ?? NULL)
            ],
            'webpage.is_home' => [
                'boolean'
            ],
            'webpage.is_enabled' => [
                'boolean'
            ],

            'webpagelanguage.web_page_template_id' => [
                'required', 'numeric', Rule::exists(WebPageTemplate::class, 'id')->where('web_site_id', $this->input('webpage')['web_site_id'] ?? NULL)
            ],
            'webpagelanguage.title' => [
                'required', 'max:255'
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
        ];
    }
}
