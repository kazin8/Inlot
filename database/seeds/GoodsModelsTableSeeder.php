<?php

use Illuminate\Database\Seeder;

class GoodsModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $goodsModels = \App\GoodsModels::all();

        if (count($goodsModels)) {
            foreach ($goodsModels as $row) {
                $row->update(['mark_id' => \App\CarModel::find($row->model_id)['mark_id']]);
            }
        }
    }
}
