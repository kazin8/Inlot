<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Транспорт и запчасти'
        ]);

        DB::table('categories')->insert([
            'pid' => 1,
            'table_name' => 'cars',
            'name' => 'Легковые автомобили',
            'slug' => 'cars',
            'code' => 'cars'
        ]);

        DB::table('categories')->insert([
            'pid' => 1,
            'table_name' => 'auto_parts',
            'name' => 'Запчасти',
            'slug' => 'auto-parts',
            'code' => 'auto_parts'
        ]);

        DB::table('categories')->insert([
            'name' => 'Шины и диски',
        ]);

        DB::table('categories')->insert([
            'pid' => 4,
            'table_name' => 'tires',
            'name' => 'Шины',
            'slug' => 'tires',
            'code' => 'tires'
        ]);

        DB::table('categories')->insert([
            'pid' => 4,
            'table_name' => 'rims',
            'name' => 'Диски',
            'slug' => 'rims',
            'code' => 'rims'
        ]);

        DB::table('categories')->insert([
            'pid' => 4,
            'table_name' => 'wheels',
            'name' => 'Колеса',
            'slug' => 'wheels',
            'code' => 'wheels'
        ]);
    }
}
