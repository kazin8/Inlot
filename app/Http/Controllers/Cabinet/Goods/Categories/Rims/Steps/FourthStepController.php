<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories\Rims\Steps;

use App\Goods;
use App\Http\Controllers\Cabinet\Goods\Categories\StepController;
use App\Rim;
use Illuminate\Http\Request;

use App\Http\Requests;

class FourthStepController extends StepController
{
    public $status = Goods::FOURTH_STEP_ADDITION;

    public function view()
    {
        $goods = $this->goods;
        $rim = Rim::find($goods->item_id);

        return view('cabinet.goods.categories.rims.step_4', compact('goods', 'rim'));
    }

    public function execute()
    {
        $this->goodsController->activate($this->goods);

        return redirect()->route('goods.item', ['goods' => $this->goods->id]);
    }
}
