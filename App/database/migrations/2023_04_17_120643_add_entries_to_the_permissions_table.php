<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $array = [
            ['name' => 'Cms:Block:Index', 'description' => 'Блоки : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Block:Create', 'description' => 'Блоки : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Block:View', 'description' => 'Блоки : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Block:Update', 'description' => 'Блоки : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Block:Delete', 'description' => 'Блоки : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:Form:Index', 'description' => 'Формы : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Form:Create', 'description' => 'Формы : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Form:View', 'description' => 'Формы : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Form:Update', 'description' => 'Формы : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Form:Delete', 'description' => 'Формы : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:Input:Index', 'description' => 'Поля форм : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Input:Create', 'description' => 'Поля форм : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Input:View', 'description' => 'Поля форм : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Input:Update', 'description' => 'Поля форм : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Input:Delete', 'description' => 'Поля форм : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:Language:Index', 'description' => 'Языки : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Language:Create', 'description' => 'Языки : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Language:View', 'description' => 'Языки : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Language:Update', 'description' => 'Языки : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Language:Delete', 'description' => 'Языки : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:FileManagement:Index', 'description' => 'Файловый менеджер : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:FileManagement:Create', 'description' => 'Файловый менеджер : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:FileManagement:View', 'description' => 'Файловый менеджер : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:FileManagement:Delete', 'description' => 'Файловый менеджер : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:Module:Index', 'description' => 'Модули : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Module:Create', 'description' => 'Модули : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Module:View', 'description' => 'Модули : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Module:Update', 'description' => 'Модули : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Module:Delete', 'description' => 'Модули : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:User:Index', 'description' => 'Пользователи : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:User:Create', 'description' => 'Пользователи : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:User:View', 'description' => 'Пользователи : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:User:Update', 'description' => 'Пользователи : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:User:Delete', 'description' => 'Пользователи : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:Resource:Index', 'description' => 'Ресурсы : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Resource:Create', 'description' => 'Ресурсы : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Resource:Update', 'description' => 'Ресурсы : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:Resource:Delete', 'description' => 'Ресурсы : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:WebSite:Index', 'description' => 'Веб-сайты : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebSite:Create', 'description' => 'Веб-сайты : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebSite:View', 'description' => 'Веб-сайты : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebSite:Update', 'description' => 'Веб-сайты : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebSite:Delete', 'description' => 'Веб-сайты : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebSite:Copy', 'description' => 'Веб-сайты : Копирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebSite:Code', 'description' => 'Веб-сайты : Дополнительный код', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:WebPage:Index', 'description' => 'Веб-сайты : Страницы : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebPage:Create', 'description' => 'Веб-сайты : Страницы : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebPage:View', 'description' => 'Веб-сайты : Страницы : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebPage:Update', 'description' => 'Веб-сайты : Страницы : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebPage:Delete', 'description' => 'Веб-сайты : Страницы : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebPage:Copy', 'description' => 'Веб-сайты : Страницы : Копирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:WebVariable:Index', 'description' => 'Веб-сайты : Переменные : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebVariable:Create', 'description' => 'Веб-сайты : Переменные : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebVariable:View', 'description' => 'Веб-сайты : Переменные : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebVariable:Update', 'description' => 'Веб-сайты : Переменные : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebVariable:Delete', 'description' => 'Веб-сайты : Переменные : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:WebPageTemplate:Index', 'description' => 'Веб-сайты : Шаблоны : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebPageTemplate:Create', 'description' => 'Веб-сайты : Шаблоны : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebPageTemplate:View', 'description' => 'Веб-сайты : Шаблоны : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebPageTemplate:Update', 'description' => 'Веб-сайты : Шаблоны : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebPageTemplate:Delete', 'description' => 'Веб-сайты : Шаблоны : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:WebBlock:Index', 'description' => 'Веб-сайты : Блоки : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebBlock:Create', 'description' => 'Веб-сайты : Блоки : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebBlock:View', 'description' => 'Веб-сайты : Блоки : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebBlock:Update', 'description' => 'Веб-сайты : Блоки : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebBlock:Delete', 'description' => 'Веб-сайты : Блоки : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:WebBreadcrumb:Index', 'description' => 'Веб-сайты : Хлебные крошки : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebBreadcrumb:Create', 'description' => 'Веб-сайты : Хлебные крошки : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebBreadcrumb:View', 'description' => 'Веб-сайты : Хлебные крошки : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebBreadcrumb:Update', 'description' => 'Веб-сайты : Хлебные крошки : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebBreadcrumb:Delete', 'description' => 'Веб-сайты : Хлебные крошки : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:WebMenu:Index', 'description' => 'Веб-сайты : Меню : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebMenu:Create', 'description' => 'Веб-сайты : Меню : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebMenu:View', 'description' => 'Веб-сайты : Меню : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebMenu:Update', 'description' => 'Веб-сайты : Меню : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebMenu:Delete', 'description' => 'Веб-сайты : Меню : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:WebPagination:Index', 'description' => 'Веб-сайты : Пагинации : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebPagination:Create', 'description' => 'Веб-сайты : Пагинации : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebPagination:View', 'description' => 'Веб-сайты : Пагинации : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebPagination:Update', 'description' => 'Веб-сайты : Пагинации : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebPagination:Delete', 'description' => 'Веб-сайты : Пагинации : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:WebData:Index', 'description' => 'Веб-данные : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebData:Export', 'description' => 'Веб-данные : Экспорт', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebData:View', 'description' => 'Веб-данные : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebData:Delete', 'description' => 'Веб-данные : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Cms:WebResource:Index', 'description' => 'Веб-сайты : Ресурсы : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebResource:Create', 'description' => 'Веб-сайты : Ресурсы : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebResource:Update', 'description' => 'Веб-сайты : Ресурсы : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:WebResource:Delete', 'description' => 'Веб-сайты : Ресурсы : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ];

        \Illuminate\Support\Facades\DB::table('permissions')
            ->insert($array);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
