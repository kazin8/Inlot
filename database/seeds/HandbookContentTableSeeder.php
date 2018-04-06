<?php

use Illuminate\Database\Seeder;

class HandbookContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!\App\HandbookContent::where('name', 'Внедорожник')->count()) {
            \App\HandbookContent::create(['handbook_id' => 1, 'name' => 'Внедорожник']);
        }
        if (!\App\HandbookContent::where('name', 'Кабриолет')->count()) {
            \App\HandbookContent::create(['handbook_id' => 1, 'name' => 'Кабриолет']);
        }
        if (!\App\HandbookContent::where('name', 'Кроссовер')->count()) {
            \App\HandbookContent::create(['handbook_id' => 1, 'name' => 'Кроссовер']);
        }
        if (!\App\HandbookContent::where('name', 'Пикап')->count()) {
            \App\HandbookContent::create(['handbook_id' => 1, 'name' => 'Пикап']);
        }
    }
}
