<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebPageTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_page_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(\App\Models\WebSite::class)->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('web_page_template_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Language::class);
            $table->foreignIdFor(\App\Models\WebPageTemplate::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\WebPageTemplateLanguageVersion::class)->nullable();
            $table->timestamps();
        });

        Schema::create('web_page_template_language_versions', function (Blueprint $table) {
            $table->id();
            $table->mediumText('blade')->nullable();
            $table->foreignIdFor(\App\Models\WebPageTemplateLanguage::class)->onDelete('cascade');
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
        Schema::dropIfExists('web_page_templates');
        Schema::dropIfExists('web_page_template_languages');
        Schema::dropIfExists('web_page_template_language_versions');
    }
}
