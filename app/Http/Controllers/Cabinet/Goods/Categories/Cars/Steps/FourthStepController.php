<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories\Cars\Steps;

use App\Car;
use App\Goods;
use App\Interfaces\Category;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Cabinet\Goods\Categories\StepController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * Fourth step of car's addition.
 *
 * Class FourthStepController
 * @package App\Http\Controllers\Cabinet\Goods\Categories\Cars\Steps
 */
class FourthStepController extends StepController
{

    public $status = Goods::FOURTH_STEP_ADDITION;

    /**
     * View the fourth step of car's addition.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $goods = $this->goods;
        $car = Car::find($goods->item_id);

        return view('cabinet.goods.categories.cars.step_4', compact('goods', 'car'));
    }

    /**
     * Execute the fourth step of car's addition.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function execute()
    {
        $this->goodsController->activate($this->goods);

        return redirect()->route('goods.item', ['goods' => $this->goods->id]);
    }

}
