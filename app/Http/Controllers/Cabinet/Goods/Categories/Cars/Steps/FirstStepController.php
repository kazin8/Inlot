<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories\Cars\Steps;

use Auth;

use App\Car;
use App\Goods;

use App\Http\Controllers\Cabinet\Goods\Categories\StepController;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

/**
 * First step of car's addition.
 *
 * Class FirstStepController
 * @package App\Http\Controllers\Cabinet\Goods\Categories\Cars\Steps
 */
class FirstStepController extends StepController
{

    public $status = Goods::FIRST_STEP_ADDITION;

    /**
     * View the first step of car's addition.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        return view('cabinet.goods.step_1');
    }

    /**
     * Execute the first step of car's addition.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function execute()
    {
        $car = Car::create();
        $goods = Goods::create(
            [
                'category_id' => 2,
                'item_id' => $car->id,
                'status' => $this->getNextStep(),
                'user_id' => Auth::user()->id,
                'active' => Auth::user()->may_sell
            ]
        );
        Storage::makeDirectory('/goods/' . $goods->id);

        return redirect()->route('cabinet.goods.edit', ['step' => 2, 'goods' => $goods->id]);
    }

}
