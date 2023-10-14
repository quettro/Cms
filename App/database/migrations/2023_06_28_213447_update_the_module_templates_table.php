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
            $table->foreignIdFor(\App\Models\ModuleColumn::class, 'order_by_column')->nullable()->after('blade');
            $table->string('order_by')->nullable()->after('order_by_column');
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
            $table->dropColumn('order_by_column');
            $table->dropColumn('order_by');
        });
    }
};
