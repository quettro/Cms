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
            ['name' => 'Cms:UserHistory:Index', 'description' => 'История пользователей : Таблица', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:UserHistory:Create', 'description' => 'История пользователей : Создание', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:UserHistory:View', 'description' => 'История пользователей : Просмотр', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:UserHistory:Update', 'description' => 'История пользователей : Редактирование', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cms:UserHistory:Delete', 'description' => 'История пользователей : Удаление', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
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
