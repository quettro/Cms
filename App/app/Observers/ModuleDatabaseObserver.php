<?php

namespace App\Observers;

use App\Models\ModuleDatabase;

class ModuleDatabaseObserver
{
    /**
     * @param ModuleDatabase $moduleDatabase
     * @return void
     */
    public function deleted(ModuleDatabase $moduleDatabase): void
    {
        $moduleDatabase->languages->each(static fn ($row) => $row->delete());
    }
}
