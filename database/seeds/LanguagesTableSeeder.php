<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Language::create(['code' => 'IT', 'name' => 'Italiano']);
        \App\Language::create(['code' => 'EN', 'name' => 'English']);
        \App\Language::create(['code' => 'ES', 'name' => 'Español']);
    }
}
