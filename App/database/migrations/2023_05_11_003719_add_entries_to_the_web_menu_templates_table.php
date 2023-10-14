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
        foreach (\Illuminate\Support\Facades\DB::table('web_menus')->get() as $webMenu)
        {
            $attributes = [];
            $attributes['key'] = 'default';
            $attributes['name'] = 'Default';
            $attributes['web_menu_id'] = $webMenu->id;
            $attributes['created_at'] = now();
            $attributes['updated_at'] = now();

            $webMenuTemplateId = \Illuminate\Support\Facades\DB::table('web_menu_templates')->insertGetId($attributes);

            foreach (\Illuminate\Support\Facades\DB::table('languages')->get() as $language)
            {
                $attributes = [];
                $attributes['blade'] = $webMenu->blade;
                $attributes['blade_for_recursive'] = $webMenu->blade_for_recursive;
                $attributes['language_id'] = $language->id;
                $attributes['web_menu_template_id'] = $webMenuTemplateId;
                $attributes['created_at'] = now();
                $attributes['updated_at'] = now();

                \Illuminate\Support\Facades\DB::table('web_menu_template_languages')->insert($attributes);
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
