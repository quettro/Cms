<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_data', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->json('all')->nullable();
            $table->json('validated')->nullable();
            $table->string('referer')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->foreignIdFor(\App\Models\Form::class)->nullable();
            $table->foreignIdFor(\App\Models\WebSite::class);
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
        Schema::dropIfExists('web_data');
    }
}
