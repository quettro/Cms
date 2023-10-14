<?php

namespace App\Observers;

use App\Models\WebVariableLanguage;

class WebVariableLanguageObserver
{
    /**
     * @param WebVariableLanguage $webVariableLanguage
     * @return void
     */
    public function deleted(WebVariableLanguage $webVariableLanguage): void
    {
        $webVariableLanguage->versions->each(static fn ($row) => $row->delete());
    }
}
