<?php

namespace App\Http\Controllers\Goods\Categories\Cars;

use App\Car;
use App\Http\Controllers\Goods\Categories\CategoryController;
use App\Plugins\Breadcrumbs;
use Illuminate\Http\Request;

use App\Http\Requests;

class CarController extends CategoryController
{
    
    protected $pathToImageDir = '/goods/cars/';
    
    /**
     * View the page of car's card.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $this->goodsController->setVisitedGoods($this->request, $this->goods);
        $goods = $this->goods;
        $car = Car::find($goods->item_id);

        Breadcrumbs::add(['name' => 'Легковые автомобили', 'url' => '/goods/cars']);
        Breadcrumbs::add(['name' => $goods->name]);
        Breadcrumbs::render();

        return view('goods.categories.cars.item', compact('goods', 'car'));
    }

}
