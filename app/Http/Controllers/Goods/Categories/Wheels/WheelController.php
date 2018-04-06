<?php

namespace App\Http\Controllers\Goods\Categories\Wheels;

use App\Http\Controllers\Goods\Categories\CategoryController;
use App\Plugins\Breadcrumbs;
use App\Wheel;
use Illuminate\Http\Request;

use App\Http\Requests;

class WheelController extends CategoryController
{
    protected $pathToImageDir = '/goods/wheels/';

    /**
     * View the page of car's card.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $this->goodsController->setVisitedGoods($this->request, $this->goods);
        $goods = $this->goods;
        $wheel = Wheel::find($goods->item_id);

        Breadcrumbs::add(['name' => 'Колеса', 'url' => '/goods/wheels']);
        Breadcrumbs::add(['name' => $goods->name]);
        Breadcrumbs::render();

        return view('goods.categories.wheels.item', compact('goods', 'wheel'));
    }
}
