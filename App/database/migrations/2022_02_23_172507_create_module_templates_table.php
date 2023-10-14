<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_templates', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->integer('count');
            $table->text('blade')->nullable();
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
        Schema::dropIfExists('module_templates');
    }
}
