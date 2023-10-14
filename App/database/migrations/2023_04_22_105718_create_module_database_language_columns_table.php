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
        Schema::create('module_database_language_columns', function (Blueprint $table) {
            $table->id();
            $table->text('value')->nullable();
            $table->foreignIdFor(\App\Models\ModuleColumn::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\ModuleDatabaseLanguage::class)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_database_language_columns');
    }
};
