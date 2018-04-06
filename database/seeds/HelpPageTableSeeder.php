<?php

use Illuminate\Database\Seeder;

class HelpPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('help_page')->insert([
            'name' => 'Размещение объявлений страница',
            'ord' => 1,
            'slug' => 'add-advert-1',
            'active' => true,
            'pid' => 1,
            'full_text' => 'Текст: Размещение объявлений страница',
            't' => 'Размещение объявлений страница',
            'd' => 'Размещение объявлений страница',
            'k' => ''
        ]);

        DB::table('help_page')->insert([
            'name' => 'Размещение объявлений страница 2' ,
            'ord' => 3,
            'slug' => 'add-advert-2',
            'active' => true,
            'pid' => 1,
            'full_text' => 'Текст: Размещение объявлений страница 2',
            't' => 'Размещение объявлений страница 2',
            'd' => 'Размещение объявлений страница 2',
            'k' => ''
        ]);

        DB::table('help_page')->insert([
            'name' => 'Размещение объявлений страница',
            'ord' => 2,
            'slug' => 'add-advert-3',
            'active' => true,
            'pid' => null,
            'full_text' => 'Текст: Размещение объявлений страница 3',
            't' => 'Размещение объявлений страница 3',
            'd' => 'Размещение объявлений страница 3',
            'k' => ''
        ]);

        DB::table('help_page')->insert([
            'name' => 'Размещение объявлений страница 4',
            'ord' => 1,
            'slug' => 'add-advert-4',
            'active' => true,
            'pid' => 2,
            'full_text' => 'Текст: Размещение объявлений страница 4',
            't' => 'Размещение объявлений страница 4',
            'd' => 'Размещение объявлений страница 4',
            'k' => ''
        ]);

        DB::table('help_page')->insert([
            'name' => 'Размещение объявлений страница 5',
            'ord' => 11,
            'slug' => 'add-advert-5',
            'active' => false,
            'pid' => 2,
            'full_text' => 'Текст: Размещение объявлений страница 5',
            't' => 'Размещение объявлений страница 5',
            'd' => 'Размещение объявлений страница 5',
            'k' => ''
        ]);
    }
}
