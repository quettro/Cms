<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleDatabaseLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_database_languages', function (Blueprint $table) {
            $table->id();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_route')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('name_of_the_crumb')->nullable();
            $table->foreignIdFor(\App\Models\File::class, 'og_image_file_id')->nullable();
            $table->foreignIdFor(\App\Models\Language::class);
            $table->foreignIdFor(\App\Models\ModuleDatabase::class)->onDelete('cascade');
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
        Schema::dropIfExists('module_database_languages');
    }
}
