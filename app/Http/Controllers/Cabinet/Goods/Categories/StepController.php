<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories;

use App\CategoryInterface;
use App\Goods;
use App\HintList;
use App\Http\Controllers\Cabinet\Goods\GoodsController;
use App\Interfaces\Category;
use App\Plugins\FileManager;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * The base class of classes of all steps.
 *
 * Class StepController
 * @package App\Http\Controllers\Cabinet\Goods\Categories
 */
abstract class StepController extends Controller
{

    /**
     * The current Goods entity.
     *
     * @var \App\Goods
     */
    protected $goods;

    /**
     * The current request.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public $status;

    protected $goodsController;

    /**
     * View the page of product's addition.
     *
     * @return mixed
     */
    abstract public function view();

    /**
     * Execute the step of product's addition.
     *
     * @return mixed
     */
    abstract public function execute();

    public function __construct(Goods $goods, Request $request)
    {
        $this->goods = $goods;
        $this->request = $request;
        $this->goodsController = new GoodsController();
    }

    protected function getNextStep()
    {
        return $this->status + 1;
    }

}
