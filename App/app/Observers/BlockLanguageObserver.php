<?php

namespace App\Observers;

use App\Models\BlockLanguage;

class BlockLanguageObserver
{
    /**
     * @param BlockLanguage $blockLanguage
     * @return void
     */
    public function deleted(BlockLanguage $blockLanguage): void
    {
        $blockLanguage->versions->each(static fn ($row) => $row->delete());
    }
}
