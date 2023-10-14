<?php

namespace App\Observers;

use App\Models\WebBlock;

class WebBlockObserver
{
    /**
     * @param WebBlock $webBlock
     * @return void
     */
    public function deleted(WebBlock $webBlock): void
    {
        $webBlock->languages->each(static fn ($row) => $row->delete());
    }
}
