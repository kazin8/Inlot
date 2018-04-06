<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories\AutoParts\Steps;

use App\AutoPart;
use App\Goods;
use App\Http\Controllers\Cabinet\Goods\Categories\StepController;
use Illuminate\Http\Request;

use App\Http\Requests;

class FourthStepController extends StepController
{
    public $status = Goods::FOURTH_STEP_ADDITION;

    public function view()
    {
        $goods = $this->goods;
        $autoPart = AutoPart::find($goods->item_id);

        return view('cabinet.goods.categories.auto_parts.step_4', compact('goods', 'autoPart'));
    }

    public function execute()
    {
        $this->goodsController->activate($this->goods);

        return redirect()->route('goods.item', ['goods' => $this->goods->id]);
    }
}
