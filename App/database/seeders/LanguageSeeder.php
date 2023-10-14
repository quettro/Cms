<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $language = new Language();
        $language->name = 'Русский';
        $language->codename = 'ru';
        $language->save();

        $language = new Language();
        $language->name = 'Английский';
        $language->codename = 'en';
        $language->save();
    }
}
