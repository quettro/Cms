<?php

namespace App\Observers;

use App\Models\ModuleColumn;
use App\Models\ModuleDatabaseLanguageColumn;

class ModuleColumnObserver
{
    /**
     * @param ModuleColumn $moduleColumn
     * @return void
     */
    public function deleted(ModuleColumn $moduleColumn): void
    {
        ModuleDatabaseLanguageColumn::where('module_column_id', $moduleColumn->id)->get()
            ->each(static fn ($row) => $row->delete());
    }
}
