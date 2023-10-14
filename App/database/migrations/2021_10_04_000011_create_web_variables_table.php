<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_variables', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->foreignIdFor(\App\Models\WebSite::class);
            $table->timestamps();
        });

        Schema::create('web_variable_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Language::class);
            $table->foreignIdFor(\App\Models\WebVariable::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\WebVariableLanguageVersion::class)->nullable();
            $table->timestamps();
        });

        Schema::create('web_variable_language_versions', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->foreignIdFor(\App\Models\WebVariableLanguage::class)->onDelete('cascade');
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
        Schema::dropIfExists('web_variables');
    }
}
