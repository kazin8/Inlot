<?php

namespace App\Http\Controllers\Goods\Categories\Rims;

use App\Http\Controllers\Goods\Categories\CategoryController;
use App\Plugins\Breadcrumbs;
use App\Rim;
use Illuminate\Http\Request;

use App\Http\Requests;

class RimController extends CategoryController
{
    protected $pathToImageDir = '/goods/rims/';

    /**
     * View the page of car's card.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $this->goodsController->setVisitedGoods($this->request, $this->goods);
        $goods = $this->goods;
        $rim = Rim::find($goods->item_id);

        Breadcrumbs::add(['name' => 'Диски', 'url' => '/goods/rims']);
        Breadcrumbs::add(['name' => $goods->name]);
        Breadcrumbs::render();

        return view('goods.categories.rims.item', compact('goods', 'rim'));
    }
}
