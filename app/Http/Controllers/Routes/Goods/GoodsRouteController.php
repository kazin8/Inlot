<?php

namespace App\Http\Controllers\Routes\Goods;

use App;
use App\Goods;

use App\Factories\Goods\CategoryFactory;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GoodsRouteController extends Controller
{

    /**
     * The current Goods entity.
     *
     * @var \App\Goods
     */
    private $goods;

    /**
     * The current request.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * The controller of current category.
     *
     * @var \App\Http\Controllers\Cabinet\Goods\Categories\Cars\CarController
     */
    private $categoryController;

    public function __construct(Request $request)
    {
        $this->goods = GoodsRouteController::$router->current()->parameter('goods') ?: new Goods();
        $this->request = $request;
        $this->goodsController = new App\Http\Controllers\Goods\GoodsController();
        $this->categoryController = CategoryFactory::getCategoryControllerByGoods($this->goods, $this->request);
    }

    /**
     * View the page of product's card.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        return $this->goodsController->isAvailableForViewing($this->goods) ?
            $this->categoryController->view() :
            App::abort(404);
    }

}