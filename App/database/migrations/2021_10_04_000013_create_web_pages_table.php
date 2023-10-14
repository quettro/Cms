<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('route');
            $table->text('a_route');
            $table->nestedSet();
            $table->foreignIdFor(\App\Models\WebSite::class)->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('web_page_languages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('name_of_the_crumb')->nullable();
            $table->string('redirect')->nullable();
            $table->boolean('is_home');
            $table->boolean('is_enabled');
            $table->foreignIdFor(\App\Models\File::class, 'og_image_file_id')->nullable();
            $table->foreignIdFor(\App\Models\Language::class);
            $table->foreignIdFor(\App\Models\WebPage::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\WebPageTemplate::class);
            $table->foreignIdFor(\App\Models\WebPageLanguageVersion::class)->nullable();
            $table->timestamps();
        });

        Schema::create('web_page_language_versions', function (Blueprint $table) {
            $table->id();
            $table->mediumText('blade')->nullable();
            $table->text('additional_head')->nullable();
            $table->text('additional_body')->nullable();
            $table->foreignIdFor(\App\Models\WebPageLanguage::class)->onDelete('cascade');
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
        Schema::dropIfExists('web_pages');
        Schema::dropIfExists('web_page_languages');
        Schema::dropIfExists('web_page_language_versions');
    }
}
