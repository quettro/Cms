<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FormSeeder extends Seeder
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
        $form = new Form();
        $form->key = 'form';
        $form->save();

        foreach (Language::all() as $language)
        {
            $formLanguage = $form->languages()->make();
            $formLanguage->blade = $d->get('Form/F.blade.php');
            $formLanguage->language_id = $language->id;
            $formLanguage->save();
        }
    }
}
