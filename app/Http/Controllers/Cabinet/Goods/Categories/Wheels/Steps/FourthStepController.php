<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories\Wheels\Steps;

use App\Goods;
use App\Http\Controllers\Cabinet\Goods\Categories\StepController;
use App\Wheel;
use Illuminate\Http\Request;

use App\Http\Requests;

class FourthStepController extends StepController
{
    public $status = Goods::FOURTH_STEP_ADDITION;

    public function view()
    {
        $goods = $this->goods;
        $wheel = Wheel::find($goods->item_id);

        return view('cabinet.goods.categories.wheels.step_4', compact('goods', 'wheel'));
    }

    public function execute()
    {
        $this->goodsController->activate($this->goods);

        return redirect()->route('goods.item', ['goods' => $this->goods->id]);
    }
}
