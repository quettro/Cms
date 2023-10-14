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
        Schema::create('web_block_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Language::class);
            $table->foreignIdFor(\App\Models\WebBlock::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\WebBlockLanguageVersion::class)->nullable();
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
        Schema::dropIfExists('web_block_languages');
    }
};
