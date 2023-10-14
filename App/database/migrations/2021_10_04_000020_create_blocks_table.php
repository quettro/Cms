<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('block_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Language::class);
            $table->foreignIdFor(\App\Models\Block::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\BlockLanguageVersion::class)->nullable();
            $table->timestamps();
        });

        Schema::create('block_language_versions', function (Blueprint $table) {
            $table->id();
            $table->text('blade')->nullable();
            $table->foreignIdFor(\App\Models\BlockLanguage::class)->onDelete('cascade');
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
        Schema::dropIfExists('blocks');
        Schema::dropIfExists('block_languages');
        Schema::dropIfExists('block_language_versions');
    }
}
