<?php

namespace App\Observers;

use App\Models\WebMenu;

class WebMenuObserver
{
    /**
     * @param WebMenu $webMenu
     * @return void
     */
    public function deleted(WebMenu $webMenu): void
    {
        $webMenu->webMenuItems->each(static fn ($row) => $row->delete());
    }
}
