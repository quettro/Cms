<?php

namespace App\Observers;

use App\Enums\ModuleColumnType;
use App\Enums\ModuleType;
use App\Models\Module;

class ModuleObserver
{
    /**
     * @param Module $module
     * @return void
     */
    public function deleted(Module $module): void
    {
        $module->moduleColumns->each(static fn ($row) => $row->delete());

        $module->moduleDatabase->each(static fn ($row) => $row->delete());

        $module->moduleTemplates->each(static fn ($row) => $row->delete());
    }

    /**
     * @param Module $module
     * @return void
     */
    public function created(Module $module): void
    {
        if ($module->type->is(ModuleType::GALLERY)) {
            $attributes = [];
            $attributes['key'] = 'file';
            $attributes['name'] = 'Файл';
            $attributes['type'] = ModuleColumnType::_FILE;
            $attributes['required'] = true;

            $module->moduleColumns()->create($attributes);
        }
    }
}
