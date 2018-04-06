<?php

namespace App\Http\Controllers\Routes\Cabinet;

use App\Goods;
use App;

use App\Factories\Cabinet\Goods\CategoryFactory;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $this->categoryController = CategoryFactory::getCategoryControllerByGoods($this->goods, $this->request);
    }

    /**
     * View the page of product's creating.
     *
     * @return mixed
     */
    public function create()
    {
        return view('cabinet.goods.step_1');
    }

    /**
     * Store the product.
     *
     * @return mixed
     */
    public function store()
    {
        return $this->categoryController->store();
    }

    /**
     * View the page of product's edition.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit()
    {
        return $this->categoryController->edit();
    }

    /**
     * Update the product.
     *
     * @return mixed
     */
    public function update()
    {
        return $this->categoryController->update();
    }

}
