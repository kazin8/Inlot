<?php

namespace App\Http\Controllers\Goods\Categories;

use App\Goods;
use App\Http\Controllers\Goods\GoodsController;
use App\Interfaces\Category;
use App\Plugins\FileManager;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

abstract class CategoryController extends Controller
{

    protected $goods;

    protected $request;

    protected $goodsController;

    abstract public function view();

    public function __construct(Goods $goods, Request $request = null)
    {
        $this->goods = $goods;
        $this->request = $request;
        $this->goodsController = new GoodsController();
    }

}
