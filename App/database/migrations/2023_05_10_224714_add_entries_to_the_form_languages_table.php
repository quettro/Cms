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
        foreach (\Illuminate\Support\Facades\DB::table('forms')->get() as $form)
        {
            foreach (\Illuminate\Support\Facades\DB::table('languages')->get() as $language)
            {
                $attributes = [];
                $attributes['blade'] = $form->blade;
                $attributes['language_id'] = $language->id;
                $attributes['form_id'] = $form->id;
                $attributes['created_at'] = now();
                $attributes['updated_at'] = now();

                \Illuminate\Support\Facades\DB::table('form_languages')->insert($attributes);
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
