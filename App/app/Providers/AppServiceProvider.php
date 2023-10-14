<?php

namespace App\Providers;

use App\Macros\QueryBuilderMacros;
use App\Models\Block;
use App\Models\BlockLanguage;
use App\Models\File;
use App\Models\Module;
use App\Models\ModuleColumn;
use App\Models\ModuleDatabase;
use App\Models\ModuleDatabaseLanguage;
use App\Models\ModuleDatabaseLanguageColumn;
use App\Models\Resource;
use App\Models\WebBlock;
use App\Models\WebBlockLanguage;
use App\Models\WebMenu;
use App\Models\WebMenuItem;
use App\Models\WebPage;
use App\Models\WebPageLanguage;
use App\Models\WebPageTemplate;
use App\Models\WebPageTemplateLanguage;
use App\Models\WebResource;
use App\Models\WebSite;
use App\Models\WebVariable;
use App\Models\WebVariableLanguage;
use App\Observers\BlockLanguageObserver;
use App\Observers\BlockObserver;
use App\Observers\FileObserver;
use App\Observers\ModuleColumnObserver;
use App\Observers\ModuleDatabaseLanguageColumnObserver;
use App\Observers\ModuleDatabaseLanguageObserver;
use App\Observers\ModuleDatabaseObserver;
use App\Observers\ModuleObserver;
use App\Observers\ResourceObserver;
use App\Observers\WebBlockLanguageObserver;
use App\Observers\WebBlockObserver;
use App\Observers\WebMenuItemObserver;
use App\Observers\WebMenuObserver;
use App\Observers\WebPageLanguageObserver;
use App\Observers\WebPageObserver;
use App\Observers\WebPageTemplateLanguageObserver;
use App\Observers\WebPageTemplateObserver;
use App\Observers\WebResourceObserver;
use App\Observers\WebSiteObserver;
use App\Observers\WebVariableLanguageObserver;
use App\Observers\WebVariableObserver;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register() {
        //
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function boot(): void
    {
        /**
         *
         */
        Builder::mixin(new QueryBuilderMacros());

        /**
         *
         */
        Paginator::useBootstrapFive();

        /**
         *
         */
        BlockLanguage::observe(BlockLanguageObserver::class);
        Block::observe(BlockObserver::class);
        File::observe(FileObserver::class);
        ModuleColumn::observe(ModuleColumnObserver::class);
        ModuleDatabaseLanguageColumn::observe(ModuleDatabaseLanguageColumnObserver::class);
        ModuleDatabaseLanguage::observe(ModuleDatabaseLanguageObserver::class);
        ModuleDatabase::observe(ModuleDatabaseObserver::class);
        Module::observe(ModuleObserver::class);
        Resource::observe(ResourceObserver::class);
        WebBlockLanguage::observe(WebBlockLanguageObserver::class);
        WebBlock::observe(WebBlockObserver::class);
        WebMenuItem::observe(WebMenuItemObserver::class);
        WebMenu::observe(WebMenuObserver::class);
        WebPageLanguage::observe(WebPageLanguageObserver::class);
        WebPage::observe(WebPageObserver::class);
        WebPageTemplateLanguage::observe(WebPageTemplateLanguageObserver::class);
        WebPageTemplate::observe(WebPageTemplateObserver::class);
        WebResource::observe(WebResourceObserver::class);
        WebSite::observe(WebSiteObserver::class);
        WebVariableLanguage::observe(WebVariableLanguageObserver::class);
        WebVariable::observe(WebVariableObserver::class);
    }
}
