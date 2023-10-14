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
        Schema::create('web_menu_template_languages', function (Blueprint $table) {
            $table->id();
            $table->text('blade')->nullable();
            $table->text('blade_for_recursive')->nullable();
            $table->foreignIdFor(\App\Models\Language::class);
            $table->foreignIdFor(\App\Models\WebMenuTemplate::class)->onDelete('cascade');
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
        Schema::dropIfExists('web_menu_template_languages');
    }
};
