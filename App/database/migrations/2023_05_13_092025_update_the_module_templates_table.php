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
        Schema::table('module_templates', function (Blueprint $table) {
            $table->dropColumn('order_by');
            $table->dropColumn('order_by_column');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('module_templates', function (Blueprint $table) {
            $table->integer('order_by')->nullable()->after('count');
            $table->foreignIdFor(\App\Models\ModuleColumn::class, 'order_by_column')->nullable()->after('order_by');
        });
    }
};
