<?php

namespace App\Observers;

use App\Models\WebBlockLanguage;

class WebBlockLanguageObserver
{
    /**
     * @param WebBlockLanguage $webBlockLanguage
     * @return void
     */
    public function deleted(WebBlockLanguage $webBlockLanguage): void
    {
        $webBlockLanguage->versions->each(static fn ($row) => $row->delete());
    }
}
