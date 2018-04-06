<?php

namespace App\Http\Controllers\Goods\Categories\AutoParts;

use App\AutoPart;
use App\Http\Controllers\Goods\Categories\CategoryController;
use App\Plugins\Breadcrumbs;
use Illuminate\Http\Request;

use App\Http\Requests;

class AutoPartController extends CategoryController
{
    protected $pathToImageDir = '/goods/auto_parts/';

    /**
     * View the page of car's card.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $this->goodsController->setVisitedGoods($this->request, $this->goods);
        $goods = $this->goods;
        $autoPart = AutoPart::find($goods->item_id);

        Breadcrumbs::add(['name' => 'Запчасти', 'url' => '/goods/auto-parts']);
        Breadcrumbs::add(['name' => $goods->name]);
        Breadcrumbs::render();

        return view('goods.categories.auto_parts.item', compact('goods', 'autoPart'));
    }
}
