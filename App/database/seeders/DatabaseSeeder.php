<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $this->call([LanguageSeeder::class]);

        $this->call([FormSeeder::class, InputSeeder::class, ModuleSeeder::class]);

        $this->call([UserSeeder::class]);
    }
}
