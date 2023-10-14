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
        foreach (\Illuminate\Support\Facades\DB::table('inputs')->get() as $input)
        {
            foreach (\Illuminate\Support\Facades\DB::table('languages')->get() as $language)
            {
                $attributes = [];
                $attributes['blade'] = $input->blade;
                $attributes['language_id'] = $language->id;
                $attributes['input_id'] = $input->id;
                $attributes['created_at'] = now();
                $attributes['updated_at'] = now();

                \Illuminate\Support\Facades\DB::table('input_languages')->insert($attributes);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
