<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories\Tires\Steps;

use App\Goods;
use App\Http\Controllers\Cabinet\Goods\Categories\StepController;
use App\Tire;
use Illuminate\Http\Request;

use App\Http\Requests;

class FourthStepController extends StepController
{
    public $status = Goods::FOURTH_STEP_ADDITION;

    public function view()
    {
        $goods = $this->goods;
        $tire = Tire::find($goods->item_id);

        return view('cabinet.goods.categories.tires.step_4', compact('goods', 'tire'));
    }

    public function execute()
    {
        $this->goodsController->activate($this->goods);

        return redirect()->route('goods.item', ['goods' => $this->goods->id]);
    }
}
