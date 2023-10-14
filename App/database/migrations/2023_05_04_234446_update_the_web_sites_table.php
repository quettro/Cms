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
        Schema::table('web_sites', function (Blueprint $table) {
            $table->string('ssl_certificate')->nullable()->after('body');
            $table->string('ssl_certificate_key')->nullable()->after('ssl_certificate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('web_sites', function (Blueprint $table) {
            $table->dropColumn('ssl_certificate');
            $table->dropColumn('ssl_certificate_key');
        });
    }
};
