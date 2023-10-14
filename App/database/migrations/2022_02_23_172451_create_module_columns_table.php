<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_columns', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->string('type');
            $table->boolean('table')->default(0);
            $table->boolean('required')->default(0);
            $table->foreignIdFor(\App\Models\Module::class)->onDelete('cascade');
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
        Schema::dropIfExists('module_columns');
    }
}
