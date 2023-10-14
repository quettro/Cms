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
        Schema::table('web_menu_item_languages', function (Blueprint $table) {
            $table->boolean('is_enabled')->default(false)->after('route');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('web_menu_item_languages', function (Blueprint $table) {
            $table->dropColumn('is_enabled');
        });
    }
};
