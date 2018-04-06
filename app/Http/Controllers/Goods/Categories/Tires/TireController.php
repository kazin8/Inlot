<?php

namespace App\Http\Controllers\Goods\Categories\Tires;

use App\Http\Controllers\Goods\Categories\CategoryController;
use App\Plugins\Breadcrumbs;
use App\Tire;
use Illuminate\Http\Request;

use App\Http\Requests;

class TireController extends CategoryController
{
    protected $pathToImageDir = '/goods/tires/';

    /**
     * View the page of car's card.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $this->goodsController->setVisitedGoods($this->request, $this->goods);
        $goods = $this->goods;
        $tire = Tire::find($goods->item_id);

        Breadcrumbs::add(['name' => 'Шины', 'url' => '/goods/tires']);
        Breadcrumbs::add(['name' => $goods->name]);
        Breadcrumbs::render();

        return view('goods.categories.tires.item', compact('goods', 'tire'));
    }
}
