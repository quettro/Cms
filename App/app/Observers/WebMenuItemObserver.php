<?php

namespace App\Observers;

use App\Models\WebMenu;
use App\Models\WebMenuItem;

class WebMenuItemObserver
{
    /**
     * @param WebMenuItem $webMenuItem
     * @return void
     */
    public function deleted(WebMenuItem $webMenuItem): void
    {
        $webMenuItem->languages->each(static fn ($row) => $row->delete());
    }
}
