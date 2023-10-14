<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_menus', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->text('blade')->nullable();
            $table->text('blade_for_recursive')->nullable();
            $table->foreignIdFor(\App\Models\WebSite::class)->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('web_menu_items', function (Blueprint $table) {
            $table->id();
            $table->integer('index');
            $table->nestedSet();
            $table->foreignIdFor(\App\Models\WebMenu::class)->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('web_menu_item_languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('route');
            $table->text('blade')->nullable();
            $table->foreignIdFor(\App\Models\Language::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\WebMenuItem::class)->onDelete('cascade');
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
        Schema::dropIfExists('web_menus');
        Schema::dropIfExists('web_menu_items');
        Schema::dropIfExists('web_menu_item_languages');
    }
}
