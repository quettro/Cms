<?php

namespace App\Observers;

use App\Models\WebPageTemplateLanguage;

class WebPageTemplateLanguageObserver
{
    /**
     * @param WebPageTemplateLanguage $webPageTemplateLanguage
     * @return void
     */
    public function deleted(WebPageTemplateLanguage $webPageTemplateLanguage): void
    {
        $webPageTemplateLanguage->versions->each(static fn ($row) => $row->delete());
    }
}
