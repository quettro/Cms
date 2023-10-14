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
        Schema::table('web_page_languages', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\WebPageTemplate::class)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('web_page_languages', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\WebPageTemplate::class)->change();
        });
    }
};
