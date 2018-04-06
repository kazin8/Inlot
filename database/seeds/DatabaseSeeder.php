<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /*$this->call(UsersTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(HandbooksTableSeeder::class);
        $this->call(HandbooksContentTableSeeder::class);
        $this->call(MarksTableSeeder::class);
        $this->call(ModelsTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(HelpCategoryTableSeeder::class);
        $this->call(HelpPageTableSeeder::class);*/

        $this->call(GoodsModelsTableSeeder::class);
        $this->call(HandbookContentTableSeeder::class);

        Model::reguard();
    }
}
