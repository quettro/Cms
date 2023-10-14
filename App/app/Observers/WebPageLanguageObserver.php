<?php

namespace App\Observers;

use App\Models\WebPageLanguage;

class WebPageLanguageObserver
{
    /**
     * @param WebPageLanguage $webPageLanguage
     * @return void
     */
    public function creating(WebPageLanguage $webPageLanguage): void
    {
        if (empty($webPageLanguage->title)) {
            $webPageLanguage->title = $webPageLanguage->webPage->name;
        }

        if (empty($webPageLanguage->og_title)) {
            $webPageLanguage->og_title = $webPageLanguage->title;
        }

        if (empty($webPageLanguage->og_description) && !empty($webPageLanguage->description)) {
            $webPageLanguage->og_description = $webPageLanguage->description;
        }

        if(empty($webPageLanguage->name_of_the_crumb)) {
            $webPageLanguage->name_of_the_crumb = $webPageLanguage->webPage->name;
        }
    }

    /**
     * @param WebPageLanguage $webPageLanguage
     * @return void
     */
    public function deleted(WebPageLanguage $webPageLanguage): void
    {
        $webPageLanguage->versions->each(static fn ($row) => $row->delete());
    }
}
