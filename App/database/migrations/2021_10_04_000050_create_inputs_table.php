<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputs', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->text('blade')->nullable();
            $table->string('v_regex')->nullable();
            $table->string('v_not_regex')->nullable();
            $table->boolean('v_required')->default(0);
            $table->boolean('v_alpha')->default(0);
            $table->boolean('v_alpha_dash')->default(0);
            $table->boolean('v_alpha_num')->default(0);
            $table->boolean('v_string')->default(0);
            $table->boolean('v_numeric')->default(0);
            $table->boolean('v_email')->default(0);
            $table->boolean('v_boolean')->default(0);
            $table->boolean('v_accepted')->default(0);
            $table->boolean('v_ip')->default(0);
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
        Schema::dropIfExists('inputs');
    }
}
