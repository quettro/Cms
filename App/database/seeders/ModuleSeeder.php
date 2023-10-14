<?php

namespace Database\Seeders;

use App\Enums\ModuleColumnType;
use App\Enums\ModuleType;
use App\Models\ModuleColumn;
use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        /**
         * Новости
         */
        $module = new Module();
        $module->key = 'news';
        $module->name = 'Новости';
        $module->dateformat = 'd/m/Y';
        $module->timeformat = 'H:i';
        $module->type = ModuleType::INDIVIDUAL;
        $module->route = 'media/news';
        $module->child_route = 'module';
        $module->save();

        $moduleColumn = new ModuleColumn();
        $moduleColumn->key = 'created_at';
        $moduleColumn->name = 'Дата создания';
        $moduleColumn->type = ModuleColumnType::_DATE;
        $moduleColumn->table = true;
        $moduleColumn->required = true;
        $moduleColumn->module_id = $module->id;
        $moduleColumn->save();

        $moduleColumn = new ModuleColumn();
        $moduleColumn->key = 'content';
        $moduleColumn->name = 'Контент';
        $moduleColumn->type = ModuleColumnType::_CODEMIRROR;
        $moduleColumn->required = true;
        $moduleColumn->module_id = $module->id;
        $moduleColumn->save();

        $moduleColumn = new ModuleColumn();
        $moduleColumn->key = 'image';
        $moduleColumn->name = 'Изображение';
        $moduleColumn->type = ModuleColumnType::_FILE;
        $moduleColumn->module_id = $module->id;
        $moduleColumn->save();

        $moduleColumn = new ModuleColumn();
        $moduleColumn->key = 'title';
        $moduleColumn->name = 'Заголовок';
        $moduleColumn->type = ModuleColumnType::_STRING;
        $moduleColumn->table = true;
        $moduleColumn->required = true;
        $moduleColumn->module_id = $module->id;
        $moduleColumn->save();

        /**
         * Пресс-релизы и Пост-релизы
         */
        $module = new Module();
        $module->key = 'press';
        $module->name = 'Пресс-релизы и Пост-релизы';
        $module->dateformat = 'd/m/Y';
        $module->timeformat = 'H:i';
        $module->type = ModuleType::INDIVIDUAL;
        $module->route = 'media/press';
        $module->child_route = 'module';
        $module->save();

        $moduleColumn = new ModuleColumn();
        $moduleColumn->key = 'created_at';
        $moduleColumn->name = 'Дата создания';
        $moduleColumn->type = ModuleColumnType::_DATE;
        $moduleColumn->table = true;
        $moduleColumn->required = true;
        $moduleColumn->module_id = $module->id;
        $moduleColumn->save();

        $moduleColumn = new ModuleColumn();
        $moduleColumn->key = 'content';
        $moduleColumn->name = 'Контент';
        $moduleColumn->type = ModuleColumnType::_CODEMIRROR;
        $moduleColumn->required = true;
        $moduleColumn->module_id = $module->id;
        $moduleColumn->save();

        $moduleColumn = new ModuleColumn();
        $moduleColumn->key = 'title';
        $moduleColumn->name = 'Заголовок';
        $moduleColumn->type = ModuleColumnType::_STRING;
        $moduleColumn->table = true;
        $moduleColumn->required = true;
        $moduleColumn->module_id = $module->id;
        $moduleColumn->save();

        /**
         * Деловая программа
         */
        $module = new Module();
        $module->key = 'events';
        $module->name = 'Деловая программа';
        $module->dateformat = 'd/m/Y';
        $module->timeformat = 'H:i';
        $module->type = ModuleType::DEFAULT;
        $module->save();

        /**
         * Фоторепортажи
         */
        $module = new Module();
        $module->key = 'gallery';
        $module->name = 'Фоторепортажи';
        $module->dateformat = 'd/m/Y';
        $module->timeformat = 'H:i';
        $module->type = ModuleType::GALLERY;
        $module->save();

        $moduleColumn = new ModuleColumn();
        $moduleColumn->key = 'year';
        $moduleColumn->name = 'Год';
        $moduleColumn->type = ModuleColumnType::_INTEGER;
        $moduleColumn->table = true;
        $moduleColumn->required = true;
        $moduleColumn->module_id = $module->id;
        $moduleColumn->save();

        /**
         * Видеорепортажи
         */
        $module = new Module();
        $module->key = 'video';
        $module->name = 'Видеорепортажи';
        $module->dateformat = 'd/m/Y';
        $module->timeformat = 'H:i';
        $module->type = ModuleType::DEFAULT;
        $module->save();

        $moduleColumn = new ModuleColumn();
        $moduleColumn->key = 'youtube';
        $moduleColumn->name = 'YouTube';
        $moduleColumn->type = ModuleColumnType::_YOUTUBE;
        $moduleColumn->table = true;
        $moduleColumn->required = true;
        $moduleColumn->module_id = $module->id;
        $moduleColumn->save();
    }
}
