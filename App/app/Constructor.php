<?php

namespace App;

use App\Models\Language;
use App\Models\Module;
use App\Models\ModuleDatabase;
use App\Models\ModuleDatabaseLanguage;
use App\Models\Resource;
use App\Models\WebPage;
use App\Models\WebPageLanguage;
use App\Models\WebPageLanguageVersion;
use App\Models\WebPageTemplate;
use App\Models\WebPageTemplateLanguage;
use App\Models\WebPageTemplateLanguageVersion;
use App\Models\WebSite;
use Symfony\Component\HttpFoundation\Response;

class Constructor
{
    /**
     * @var array
     */
    public array $route;

    /**
     * @var \Illuminate\Database\Eloquent\Model|WebSite|null
     */
    public \Illuminate\Database\Eloquent\Model|WebSite|null $webSite = null;

    /**
     * @var \Illuminate\Database\Eloquent\Model|Language|null
     */
    public \Illuminate\Database\Eloquent\Model|Language|null $language = null;

    /**
     * @var \Illuminate\Database\Eloquent\Model|Module|null
     */
    public \Illuminate\Database\Eloquent\Model|Module|null $module = null;

    /**
     * @var \Illuminate\Database\Eloquent\Model|ModuleDatabase|null
     */
    public \Illuminate\Database\Eloquent\Model|ModuleDatabase|null $moduleDatabase = null;

    /**
     * @var \Illuminate\Database\Eloquent\Model|ModuleDatabaseLanguage|null
     */
    public \Illuminate\Database\Eloquent\Model|ModuleDatabaseLanguage|null $moduleDatabaseTranslated = null;

    /**
     * @var \Illuminate\Database\Eloquent\Model|WebPage|null
     */
    public \Illuminate\Database\Eloquent\Model|WebPage|null $webPage = null;

    /**
     * @var \Illuminate\Database\Eloquent\Model|WebPageLanguage|null
     */
    public \Illuminate\Database\Eloquent\Model|WebPageLanguage|null $webPageLanguage = null;

    /**
     * @var \Illuminate\Database\Eloquent\Model|WebPageLanguageVersion|null
     */
    public \Illuminate\Database\Eloquent\Model|WebPageLanguageVersion|null $webPageLanguageVersion = null;

    /**
     * @var \Illuminate\Database\Eloquent\Model|WebPageTemplate|null
     */
    public \Illuminate\Database\Eloquent\Model|WebPageTemplate|null $webPageTemplate = null;

    /**
     * @var \Illuminate\Database\Eloquent\Model|WebPageTemplateLanguage|null
     */
    public \Illuminate\Database\Eloquent\Model|WebPageTemplateLanguage|null $webPageTemplateLanguage = null;

    /**
     * @var \Illuminate\Database\Eloquent\Model|WebPageTemplateLanguageVersion|null
     */
    public \Illuminate\Database\Eloquent\Model|WebPageTemplateLanguageVersion|null $webPageTemplateLanguageVersion = null;

    /**
     * @var \Illuminate\Database\Eloquent\Collection
     */
    public \Illuminate\Database\Eloquent\Collection $resources;

    /**
     * @return ConstructorSeo
     */
    public function seo(): ConstructorSeo
    {
        $constructorSeo = new ConstructorSeo();
        $constructorSeo->setConstructor($this);

        return $constructorSeo;
    }

    /**
     * @return ConstructorRender
     */
    public function render(): ConstructorRender
    {
        $constructorRender = new ConstructorRender();
        $constructorRender->setConstructor($this);

        return $constructorRender;
    }

    /**
     * @return void
     */
    public function collect(): void
    {
        /**
         * Веб-сайт
         */
        $this->webSite = WebSite::where(['domain' => request()->getHttpHost(), 'enabled' => true])->first();

        abort_if(empty($this->webSite), Response::HTTP_SERVICE_UNAVAILABLE);

        /**
         * Маршрут
         */
        $this->route['_'] = WebPage::clearTheRouteOfExtraCharacters(request()->getPathInfo());

        /**
         * Кодовое название языка из маршрута
         */
        $codename = str($this->route['_'])->explode('/')->first();

        /**
         * Язык
         */
        $this->language = Language::where(['codename' => $codename])->first() ?: $this->webSite->language;

        /**
         * Чистый маршрут
         */
        $this->route['pure'] = WebPage::clearTheRouteOfExtraCharacters(preg_replace([('/^' . $this->language->codename . '(|\/)/')], '', $this->route['_']));

        /**
         * Маршрут с кодовым названием языка
         */
        $this->route['withLanguage'] = WebPage::clearTheRouteOfExtraCharacters($this->language->codename . '/' . $this->route['pure']);

        /**
         * Маршрут без кодового названия языка и без последнего слога
         */
        $this->route['pureAndWithoutTheLastSyllable'] = str($this->route['pure'])->explode('/')->slice(0, -1)->join('/');

        /**
         * Последний слог маршрута
         */
        $this->route['theLastSyllable'] = str($this->route['pure'])->explode('/')->last();

        /**
         * Модуль
         */
        $this->module = Module::where(['route' => $this->route['pureAndWithoutTheLastSyllable']])->first();

        /**
         * Веб-страница
         */
        $queryBuilder = $this->webSite->webPages();
        $queryBuilder->whereIn('a_route', [$this->route['pure'], $this->module?->a_route]);

        $this->webPage = $queryBuilder->first();

        /**
         *
         */
        if (empty($this->webPage))
        {
            /**
             *
             */
            abort_if(!preg_match('/^\/$/', $this->route['pure']), 404);

            /**
             *
             */
            $queryBuilder = $this->webSite->webPages();
            $queryBuilder->select(['web_pages.*']);
            $queryBuilder->join('web_page_languages', 'web_pages.id', '=', 'web_page_languages.web_page_id');
            $queryBuilder->where(['web_page_languages.is_home' => true]);
            $queryBuilder->where(['web_page_languages.language_id' => $this->language->id]);

            $this->webPage = $queryBuilder->firstOrFail();
        }

        /**
         * Языковая версия веб-страницы
         */
        $queryBuilder = $this->webPage->languages();
        $queryBuilder->where(['language_id' => $this->language->id, 'is_enabled' => true]);

        $this->webPageLanguage = $queryBuilder->firstOrFail();

        redirect_now_if(!empty($this->webPageLanguage->redirect), $this->webPageLanguage->redirect);

        /**
         * Исходный код веб-страницы
         */
        $this->webPageLanguageVersion = $this->webPageLanguage->version;

        abort_if(empty($this->webPageLanguageVersion), Response::HTTP_NOT_FOUND);

        /**
         * Шаблон страницы
         */
        $this->webPageTemplate = $this->webPageLanguage->webPageTemplate;

        /**
         * Языковая версия шаблона страницы
         */
        $queryBuilder = $this->webPageTemplate?->languages();
        $queryBuilder?->where(['language_id' => $this->language->id]);

        $this->webPageTemplateLanguage = $queryBuilder?->firstOrFail();

        /**
         * Исходный код шаблона страницы
         */
        $this->webPageTemplateLanguageVersion = $this->webPageTemplateLanguage?->version;

        /**
         * Ресурсы
         */
        $this->resources = Resource::query()->get();
        $this->resources = $this->resources->merge($this->webSite->webResources);

        /**
         * Запись из базы данных модуля
         */
        if ($this->module) {
            $queryBuilder = $this->module->moduleDatabase();
            $queryBuilder->select(['module_databases.*']);
            $queryBuilder->join('module_database_languages', 'module_databases.id', '=', 'module_database_languages.module_database_id');
            $queryBuilder->join('module_database_web_sites', 'module_databases.id', '=', 'module_database_web_sites.module_database_id');
            $queryBuilder->where(['module_database_web_sites.web_site_id' => $this->webSite->id]);
            $queryBuilder->where(['module_database_languages.seo_route' => $this->route['theLastSyllable']]);

            $this->moduleDatabase = $queryBuilder->firstOrFail();

            $this->moduleDatabaseTranslated = $this->moduleDatabase->languages()->where(['language_id' => $this->language->id])->firstOrFail();

            $href = $this->language->codename . '/' . $this->module->route;
            $href = '/' . WebPage::clearTheRouteOfExtraCharacters($href) . '/' . $this->moduleDatabaseTranslated->seo_route;

            $this->moduleDatabaseTranslated->href = $href;

            $columns = $this->moduleDatabaseTranslated->moduleDatabaseLanguageColumns;
            $columns = $columns->keyBy('moduleColumn.key');

            $this->moduleDatabaseTranslated->columns = $columns;
        }
    }
}
