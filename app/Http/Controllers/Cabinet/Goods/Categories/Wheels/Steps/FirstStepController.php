<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories\Wheels\Steps;

use Auth;
use Storage;
use App\Goods;
use App\Http\Controllers\Cabinet\Goods\Categories\StepController;
use App\Wheel;
use Illuminate\Http\Request;

use App\Http\Requests;

class FirstStepController extends StepController
{
    public $status = Goods::FIRST_STEP_ADDITION;

    public function view() {}

    public function execute()
    {
        $wheel = Wheel::create();
        $goods = Goods::create(
            [
                'category_id' => 7,
                'item_id' => $wheel->id,
                'status' => $this->getNextStep(),
                'user_id' => Auth::user()->id,
                'may_sell' => Auth::user()->may_sell
            ]
        );
        Storage::makeDirectory('/goods/' . $goods->id);

        return redirect()->route('cabinet.goods.edit', ['step' => 2, 'goods' => $goods->id]);
    }
}
