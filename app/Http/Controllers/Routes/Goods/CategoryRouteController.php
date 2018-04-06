<?php

namespace App\Http\Controllers\Routes\Goods;

use App\Factories\Goods\CategoryFactory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryRouteController extends Controller
{

    private $request;

    public function __construct(Request $request)
    {
        $slug = self::$router->current()->parameter('slug');
        $this->request = $request;
        $this->categoryController = CategoryFactory::getCategoryControllerBySlug($slug, $request);
    }

    public function goodsList()
    {
        return $this->categoryController->goodsList();
    }

    public function filterAndViewPartial()
    {
        return $this->categoryController->filterAndViewPartial();
    }

    public function pagination()
    {
        return $this->categoryController->pagination();
    }

}
