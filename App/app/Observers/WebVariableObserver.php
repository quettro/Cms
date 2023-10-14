<?php

namespace App\Observers;

use App\Models\WebVariable;

class WebVariableObserver
{
    /**
     * @param WebVariable $webVariable
     * @return void
     */
    public function deleted(WebVariable $webVariable): void
    {
        $webVariable->languages->each(static fn ($row) => $row->delete());
    }
}
