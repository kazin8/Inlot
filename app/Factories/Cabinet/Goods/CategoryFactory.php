<?php

namespace App\Factories\Cabinet\Goods;

use App\Car;
use App\Goods;
use Illuminate\Http\Request;
use App\Factories\Common\CategoryFactory as BaseCategoryFactory;

use App\Http\Requests;

/**
 * Factory for making of product's controllers.
 *
 * Class CategoryFactory
 * @package App\Factories\Cabinet\Goods
 */
class CategoryFactory extends BaseCategoryFactory
{

    /**
     * Get the entity of needle category's class.
     *
     * @param Goods $goods
     * @param Request $request
     * @return \App\Http\Controllers\Goods\Categories\Cars\CarController
     */
    public static function getCategoryControllerByGoods(Goods $goods, Request $request = null)
    {
        $categoryCode = $goods->category ? $goods->category->code : ($request ? $request->input('subcategory') : null);

        switch ($categoryCode) {
            case 'cars':
                return new \App\Http\Controllers\Cabinet\Goods\Categories\Cars\CarController($goods, $request);
            case 'auto_parts':
                return new \App\Http\Controllers\Cabinet\Goods\Categories\AutoParts\AutoPartController($goods, $request);
            case 'tires':
                return new \App\Http\Controllers\Cabinet\Goods\Categories\Tires\TireController($goods, $request);
            case 'rims':
                return new \App\Http\Controllers\Cabinet\Goods\Categories\Rims\RimController($goods, $request);
            case 'wheels':
                return new \App\Http\Controllers\Cabinet\Goods\Categories\Wheels\WheelController($goods, $request);

            default:
                return null;
        }
    }

}
