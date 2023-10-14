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
        Schema::create('input_languages', function (Blueprint $table) {
            $table->id();
            $table->text('blade')->nullable();
            $table->foreignIdFor(\App\Models\Language::class);
            $table->foreignIdFor(\App\Models\Input::class)->onDelete('cascade');
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
        Schema::dropIfExists('input_languages');
    }
};
