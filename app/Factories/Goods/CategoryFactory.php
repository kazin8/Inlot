<?php

namespace App\Factories\Goods;

use App\Category;
use Illuminate\Http\Request;
use App\Factories\Common\CategoryFactory as BaseCategoryFactory;

use App\Http\Requests;
use Mockery\CountValidator\Exception;

/**
 * Factory for making of product's controllers.
 *
 * Class CategoryFactory
 * @package App\Factories\Goods
 */
class CategoryFactory extends BaseCategoryFactory
{

    public static function getCategoryControllerBySlug($slug, Request $request)
    {
        $category = Category::findBySlug($slug);

        switch ($category->code) {
            case 'cars':
                return new \App\Http\Controllers\Goods\Categories\Cars\CarCategoryController($request);
            case 'auto_parts':
                return new \App\Http\Controllers\Goods\Categories\AutoParts\AutoPartCategoryController($request);
            case 'tires':
                return new \App\Http\Controllers\Goods\Categories\Tires\TireCategoryController($request);
            case 'rims':
                return new \App\Http\Controllers\Goods\Categories\Rims\RimCategoryController($request);
            case 'wheels':
                return new \App\Http\Controllers\Goods\Categories\Wheels\WheelCategoryController($request);
            default:
                throw new Exception('No such category.');
        }
    }

}
