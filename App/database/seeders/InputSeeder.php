<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;
use App\Models\Input;
use Illuminate\Support\Facades\Storage;

class InputSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        /**
         *
         */
        $d = Storage::disk('example');

        /**
         *
         */
        $input = new Input();
        $input->key = 'name';
        $input->name = 'Имя';
        $input->v_required = true;
        $input->v_string = true;
        $input->save();

        foreach (Language::all() as $language)
        {
            $inputLanguage = $input->languages()->make();
            $inputLanguage->blade = $d->get('Input/N.blade.php');
            $inputLanguage->language_id = $language->id;
            $inputLanguage->save();
        }

        /**
         *
         */
        $input = new Input();
        $input->key = 'phone';
        $input->name = 'Номер телефона';
        $input->v_regex = '/^7([0-9]{10})$/';
        $input->v_required = true;
        $input->save();

        foreach (Language::all() as $language)
        {
            $inputLanguage = $input->languages()->make();
            $inputLanguage->blade = $d->get('Input/P.blade.php');
            $inputLanguage->language_id = $language->id;
            $inputLanguage->save();
        }

        /**
         *
         */
        $input = new Input();
        $input->key = 'email';
        $input->name = 'Адрес электронной почты';
        $input->v_required = true;
        $input->v_email = true;
        $input->save();

        foreach (Language::all() as $language)
        {
            $inputLanguage = $input->languages()->make();
            $inputLanguage->blade = $d->get('Input/E.blade.php');
            $inputLanguage->language_id = $language->id;
            $inputLanguage->save();
        }
    }
}
