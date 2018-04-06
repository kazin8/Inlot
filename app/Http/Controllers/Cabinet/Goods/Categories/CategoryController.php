<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories;

use App\Car;
use App\Factories\Cabinet\Goods\StepFactory;
use App\Goods;
use App\Interfaces\Category;
use App\Plugins\FileManager;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

abstract class CategoryController extends Controller
{

    protected $goods;

    protected $request;

    protected $categoryDir;

    abstract public function edit();
    abstract public function update();

    public function __construct(Goods $goods, Request $request = null) {
        $this->goods = $goods;
        $this->request = $request;
    }

    /**
     * View the page of car's creating.
     *
     * @return mixed
     */
    public function create()
    {
        return $this->getCurrentStep($this->categoryDir)->view();
    }

    /**
     * Store the car.
     *
     * @return mixed
     */
    public function store()
    {
        return $this->getCurrentStep($this->categoryDir)->execute();
    }

    /**
     * Get the current Step entity of product's addition.
     *
     * @param $categoryDir
     * @return mixed
     */
    protected function getCurrentStep($categoryDir)
    {
        return StepFactory::getCurrentStep($categoryDir, $this->goods, $this->request);
    }

    /**
     * Check whether current step of car's addition is enable.
     *
     * @param \App\Http\Controllers\Cabinet\Goods\Categories\StepController $stepController
     * @return bool
     */
    protected function enableCurrentStep(StepController $stepController)
    {
        return $this->goods->status >= $stepController->status ?: false;
    }

}
