<?php

namespace App\Observers;

use App\Models\ModuleDatabaseLanguage;
use Cocur\Slugify\Slugify;

class ModuleDatabaseLanguageObserver
{
    /**
     * @param ModuleDatabaseLanguage $moduleDatabaseLanguage
     * @return void
     */
    public function deleted(ModuleDatabaseLanguage $moduleDatabaseLanguage): void
    {
        $moduleDatabaseLanguage->moduleDatabaseLanguageColumns->each(static fn ($row) => $row->delete());
    }

    /**
     * @param ModuleDatabaseLanguage $moduleDatabaseLanguage
     * @return void
     */
    public function saving(ModuleDatabaseLanguage $moduleDatabaseLanguage): void
    {
        if (!empty($moduleDatabaseLanguage->seo_title)) {
            if (empty($moduleDatabaseLanguage->og_title)) {
                $moduleDatabaseLanguage->og_title = $moduleDatabaseLanguage->seo_title;
            }

            if (empty($moduleDatabaseLanguage->name_of_the_crumb)) {
                $moduleDatabaseLanguage->name_of_the_crumb = $moduleDatabaseLanguage->seo_title;
            }

            if (empty($moduleDatabaseLanguage->seo_route)) {
                $slugify = new Slugify();
                $slugify = $slugify->slugify($moduleDatabaseLanguage->seo_title, ['ruleset' => 'russian']);

                $moduleDatabaseLanguage->seo_route = $slugify;
            }
        }
    }
}
