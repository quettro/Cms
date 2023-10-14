<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_sites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('domain')->unique();
            $table->foreignIdFor(\App\Models\Language::class);
            $table->string('charset');
            $table->string('dateformat');
            $table->string('timeformat');
            $table->text('head')->nullable();
            $table->text('body')->nullable();
            $table->boolean('enabled')->default(0);
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
        Schema::dropIfExists('web_sites');
    }
}
