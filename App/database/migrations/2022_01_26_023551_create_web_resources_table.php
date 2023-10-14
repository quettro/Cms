<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_resources', function (Blueprint $table) {
            $table->id();
            $table->integer('index');
            $table->string('position');
            $table->foreignIdFor(\App\Models\File::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\WebSite::class)->onDelete('cascade');
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
        Schema::dropIfExists('web_resources');
    }
}
