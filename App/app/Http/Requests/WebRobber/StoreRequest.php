<?php

namespace App\Http\Requests\WebRobber;

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
        $merge['route'] = WebPage::clearTheRouteOfExtraCharacters($this->input('route', ''));
        $merge['routeWithoutTheLastSyllable'] = str($merge['route'])->explode('/')->slice(0, -1)->join('/');
        $merge['routeWithoutTheLastSyllable'] = WebPage::clearTheRouteOfExtraCharacters($merge['routeWithoutTheLastSyllable']);

        $this->merge($merge);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'domain' => [
                'required', 'max:255', 'url', 'not_regex:/\/$/',
            ],
            'web_page_template_id' => [
                'required', 'numeric', Rule::exists(WebPageTemplate::class, 'id')->where('web_site_id', $this->route('webSite')->id)
            ],
            'routeWithoutTheLastSyllable' => [
                'nullable'
            ],
            'route' => [
                'required', 'max:255', 'not_regex:/^\/$/', function ($attribute, $value, $throw) {
                    if ($this->route(param: 'webSite')?->webPages()->where(['a_route' => $value])->count()) {
                        $throw('Данная страница уже существует в системе.');
                    }
                    else if (!$this->route(param: 'webSite')?->webPages()->where(['a_route' => $this->input(key: 'routeWithoutTheLastSyllable')])->count()) {
                        $throw('Для начала необходимо добавить родительскую страницу.');
                    }
                }
            ],
        ];
    }
}
