<?php

namespace App\Observers;

use App\Models\WebPageTemplate;

class WebPageTemplateObserver
{
    /**
     * @param WebPageTemplate $webPageTemplate
     * @return void
     */
    public function deleted(WebPageTemplate $webPageTemplate): void
    {
        $webPageTemplate->languages->each(static fn ($row) => $row->delete());
    }
}
