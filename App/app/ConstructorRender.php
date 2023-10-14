<?php

namespace App;

use App\Models\Block;
use App\Models\BlockLanguage;
use App\Models\BlockLanguageVersion;
use App\Models\Form;
use App\Models\FormLanguage;
use App\Models\Input;
use App\Models\InputLanguage;
use App\Models\Module;
use App\Models\ModuleTemplate;
use App\Models\WebBlock;
use App\Models\WebBlockLanguage;
use App\Models\WebBlockLanguageVersion;
use App\Models\WebBreadcrumb;
use App\Models\WebMenu;
use App\Models\WebMenuTemplate;
use App\Models\WebMenuTemplateLanguage;
use App\Models\WebPage;
use App\Models\WebPagination;
use App\Models\WebPaginationLanguage;
use App\Models\WebVariable;
use App\Models\WebVariableLanguage;
use App\Models\WebVariableLanguageVersion;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Blade;

class ConstructorRender
{
    /**
     * @var Constructor
     */
    public Constructor $constructor;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->constructor->webPageTemplateLanguageVersion ? $this->webPageTemplate() : $this->webPage();
    }

    /**
     * @param Constructor $constructor
     * @return void
     */
    public function setConstructor(Constructor $constructor): void
    {
        $this->constructor = $constructor;
    }

    /**
     * @param $blade
     * @param array $params
     * @return string
     */
    public function render($blade, array $params = []): string
    {
        return Blade::render($blade, $params + ['constructor' => $this->constructor]);
    }

    /**
     * @param string $key
     * @return string
     */
    public function form(string $key): string
    {
        /* @var Form $form */
        /* @var FormLanguage $formLanguage */

        $form = Form::where(['key' => $key])->first();
        $formLanguage = $form?->languages()->where(['language_id' => $this->constructor->language->id])->first();

        return $this->render($formLanguage?->formatted);
    }

    /**
     * @param string $key
     * @return string
     */
    public function input(string $key): string
    {
        /* @var Input $input */
        /* @var InputLanguage $inputLanguage */

        $input = Input::where(['key' => $key])->first();
        $inputLanguage = $input?->languages()->where(['language_id' => $this->constructor->language->id])->first();

        return $this->render($inputLanguage?->blade);
    }

    /**
     * @return string
     */
    public function webPage(): string
    {
        $webPageLanguageVersion = $this->constructor->webPageLanguageVersion;

        return $this->render($webPageLanguageVersion->blade);
    }

    /**
     * @return string
     */
    public function webPageTemplate(): string
    {
        $webPageTemplateLanguageVersion = $this->constructor->webPageTemplateLanguageVersion;

        return $this->render($webPageTemplateLanguageVersion->blade);
    }

    /**
     * @param string $key
     * @return string
     */
    public function block(string $key): string
    {
        /* @var Block $block */
        /* @var BlockLanguage $blockLanguage */
        /* @var BlockLanguageVersion $blockLanguageVersion */

        $block = Block::where(['key' => $key])->first();
        $blockLanguage = $block?->languages()->where(['language_id' => $this->constructor->language->id])->first();
        $blockLanguageVersion = $blockLanguage?->version;

        return $this->render($blockLanguageVersion?->blade);
    }

    /**
     * @param string $key
     * @return string
     */
    public function webBlock(string $key): string
    {
        /* @var WebBlock $webBlock */
        /* @var WebBlockLanguage $webBlockLanguage */
        /* @var WebBlockLanguageVersion $webBlockLanguageVersion */

        $webBlock = $this->constructor->webSite->webBlocks()->where(['key' => $key])->first();
        $webBlockLanguage = $webBlock?->languages()->where(['language_id' => $this->constructor->language->id])->first();
        $webBlockLanguageVersion = $webBlockLanguage?->version;

        return $this->render($webBlockLanguageVersion?->blade);
    }

    /**
     * @param string $key
     * @return HigherOrderBuilderProxy|mixed|string|null
     */
    public function webVariable(string $key): mixed
    {
        /* @var WebVariable $webVariable */
        /* @var WebVariableLanguage $webVariableLanguage */
        /* @var WebVariableLanguageVersion $webVariableLanguageVersion */

        $webVariable = $this->constructor->webSite->webVariables()->where(['key' => $key])->first();
        $webVariableLanguage = $webVariable?->languages()->where(['language_id' => $this->constructor->language->id])->first();
        $webVariableLanguageVersion = $webVariableLanguage?->version;

        return $webVariableLanguageVersion?->value;
    }

    /**
     * @param string $key
     * @param $collection
     * @return string
     */
    public function webPagination(string $key, $collection): string
    {
        /* @var WebPagination $webPagination */
        /* @var WebPaginationLanguage $webPaginationLanguage */

        $webPagination = $this->constructor->webSite->webPaginations()->where(['key' => $key])->first();
        $webPaginationLanguage = $webPagination?->languages()->where(['language_id' => $this->constructor->language->id])->first();

        return $this->render($webPaginationLanguage?->blade, ['collection' => $collection]);
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function webBreadcrumb(string $key): ?string
    {
        /* @var WebBreadcrumb $webBreadcrumb */

        $ancestors = [];

        $webBreadcrumb = $this->constructor->webSite->webBreadcrumbs();
        $webBreadcrumb->where(['key' => $key]);
        $webBreadcrumb = $webBreadcrumb->first();

        if ($webBreadcrumb) {
            $ancestors = $this->constructor->webPage->ancestors()->with(['languages']);
            $ancestors = $ancestors->get()->push($this->constructor->webPage);

            $ancestors->map(
                function ($ancestor) {
                    $href = $this->constructor->language->codename . '/' . $ancestor->a_route;
                    $href = '/' . WebPage::clearTheRouteOfExtraCharacters($href);

                    $ancestor->translated = $ancestor->languages->where('language_id', $this->constructor->language->id)->first();
                    $ancestor->translated->href = $href;

                    if ($ancestor->id === $this->constructor->webPage->id) {
                        if ($this->constructor->webPage->route === $this->constructor->module?->child_route) {
                            if (!empty($this->constructor->moduleDatabaseTranslated?->name_of_the_crumb)) {
                                $ancestor->translated->name_of_the_crumb = $this->constructor->moduleDatabaseTranslated->name_of_the_crumb;
                            }
                        }
                    }
                }
            );
        }

        return $this->render($webBreadcrumb?->blade, ['collection' => $ancestors]);
    }

    /**
     * @param string $key
     * @param string $templateKey
     * @return string|null
     */
    public function webMenu(string $key, string $templateKey): ?string
    {
        /* @var WebMenu $webMenu */
        /* @var WebMenuTemplate $webMenuTemplate */
        /* @var WebMenuTemplateLanguage $webMenuTemplateLanguage */

        $webMenu = $this->constructor->webSite->webMenu()->where(['key' => $key])->first();
        $webMenuTemplate = $webMenu?->webMenuTemplates()->where(['key' => $templateKey])->first();
        $webMenuTemplateLanguage = $webMenuTemplate?->languages()->where(['language_id' => $this->constructor->language->id])->first();

        if ($webMenuItems = $webMenu?->webMenuItems()->with(['languages'])->get()) {
            $webMenuItems->map(
                function ($webMenuItem) {
                    $href_0 = $this->constructor->route['pure'];

                    $href_1 = $this->constructor->route['withLanguage'];

                    $webMenuItem->translated = $webMenuItem->languages->where('language_id', $this->constructor->language->id)->first();
                    $webMenuItem->translated->active = in_array(WebPage::clearTheRouteOfExtraCharacters($webMenuItem->translated->route), [$href_0, $href_1]);
                }
            );
            $webMenuItems = $webMenuItems->filter(static fn ($webMenuItem) => $webMenuItem->translated->is_enabled);
        }

        return $this->render($webMenuTemplateLanguage?->blade, ['blade' => $webMenuTemplateLanguage?->blade_for_recursive, 'collection' => $webMenuItems?->toTree()]);
    }

    /**
     * @param string $key
     * @param string $templateKey
     * @return string|null
     */
    public function module(string $key, string $templateKey): ?string
    {
        /* @var Module $module */
        /* @var ModuleTemplate $moduleTemplate */

        $module = Module::where(['key' => $key])->first();
        $moduleTemplate = $module?->moduleTemplates()->where(['key' => $templateKey])->first();

        $moduleDatabase = $module?->moduleDatabase();
        $moduleDatabase?->select(['module_databases.*']);
        $moduleDatabase?->join('module_database_web_sites', 'module_databases.id', '=', 'module_database_web_sites.module_database_id');
        $moduleDatabase?->join('module_database_languages', 'module_databases.id', '=', 'module_database_languages.module_database_id');
        $moduleDatabase?->where(['module_database_web_sites.web_site_id' => $this->constructor->webSite->id]);
        $moduleDatabase?->where(['module_database_languages.language_id' => $this->constructor->language->id]);
        $moduleDatabase?->with(['languages', 'languages.moduleDatabaseLanguageColumns', 'languages.moduleDatabaseLanguageColumns.moduleColumn']);

        if ($moduleTemplate?->order_by) {
            if ($moduleTemplate?->orderByColumn === null) {
                $moduleDatabase?->orderBy('module_databases.id', $moduleTemplate->order_by->value);
            }
            else {
                $moduleDatabase?->leftJoin('module_database_language_columns', fn (JoinClause $join) =>
                    $join
                        ->on('module_database_languages.id', '=', 'module_database_language_columns.module_database_language_id')
                        ->where(['module_database_language_columns.module_column_id' => $moduleTemplate->orderByColumn->id])
                );
                $moduleDatabase?->orderBy('module_database_language_columns.value', $moduleTemplate->order_by->value);
            }
        }

        $moduleDatabase = $moduleDatabase?->paginate($moduleTemplate?->count);
        $moduleDatabase?->appends(collect(request()->query())->except(['page'])->toArray());

        $moduleDatabase?->getCollection()->map(
            function ($moduleDatabase) use ($module) {
                $moduleDatabase->translated = $moduleDatabase->languages->where('language_id', $this->constructor->language->id)->first();

                $href = $this->constructor->language->codename . '/' . $module?->route;
                $href = '/' . WebPage::clearTheRouteOfExtraCharacters($href) . '/' . $moduleDatabase->translated->seo_route;

                $moduleDatabase->translated->href = $href;

                $columns = $moduleDatabase->translated->moduleDatabaseLanguageColumns;
                $columns = $columns->keyBy('moduleColumn.key');

                $moduleDatabase->translated->columns = $columns;
            }
        );

        return $this->render($moduleTemplate?->blade, ['collection' => $moduleDatabase]);
    }
}
