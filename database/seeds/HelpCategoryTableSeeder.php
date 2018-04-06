<?php

use Illuminate\Database\Seeder;

class HelpCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('help_category')->insert([
            'name' => 'Размещение объявлений',
            'ord' => 3,
            'slug' => 'add-advert',
            'active' => true,
        ]);

        DB::table('help_category')->insert([
            'name' => 'Поиск объявлений',
            'ord' => 1,
            'slug' => 'find-advert',
            'active' => true,
        ]);

        DB::table('help_category')->insert([
            'name' => 'Тестовая категория',
            'ord' => 2,
            'slug' => 'test-help',
            'active' => false,
        ]);
    }
}
