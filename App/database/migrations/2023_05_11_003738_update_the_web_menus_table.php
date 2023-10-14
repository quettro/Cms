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
        Schema::table('web_menus', function (Blueprint $table) {
            $table->dropColumn('blade');
            $table->dropColumn('blade_for_recursive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('web_menus', function (Blueprint $table) {
            $table->text('blade')->nullable()->after('name');
            $table->text('blade_for_recursive')->nullable()->after('blade');
        });
    }
};
