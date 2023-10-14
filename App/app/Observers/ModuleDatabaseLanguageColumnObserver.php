<?php

namespace App\Observers;

use App\Models\ModuleDatabaseLanguageColumn;

class ModuleDatabaseLanguageColumnObserver
{
    /**
     * @param ModuleDatabaseLanguageColumn $moduleDatabaseLanguageColumn
     * @return void
     */
    public function deleted(ModuleDatabaseLanguageColumn $moduleDatabaseLanguageColumn): void
    {
        if ($moduleDatabaseLanguageColumn->moduleColumn?->isTypeFile()) {
            $moduleDatabaseLanguageColumn->file?->delete();
        }
    }
}
