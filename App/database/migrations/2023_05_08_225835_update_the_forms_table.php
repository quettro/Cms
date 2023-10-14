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
        Schema::table('forms', function (Blueprint $table) {
            $table->dropColumn('hid');
            $table->dropColumn('hclass');
            $table->dropColumn('henctype');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->string('hid')->nullable()->after('addresses');
            $table->string('hclass')->nullable()->after('hid');
            $table->string('henctype')->nullable()->after('hclass');
        });
    }
};
