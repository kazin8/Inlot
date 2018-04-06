<?php

namespace App\Factories\Common;

use App\Goods;
use Illuminate\Http\Request;

use App\Http\Requests;
use Mockery\CountValidator\Exception;

/**
 * Factory for making of product's controllers.
 *
 * Class CategoryFactory
 * @package App\Factories\Goods
 */
class CategoryFactory
{

    /**
     * Get the entity of needle category's class.
     *
     * @param Goods $goods
     * @param Request $request
     * @return \App\Http\Controllers\Goods\Categories\AutoParts\AutoPartController|\App\Http\Controllers\Goods\Categories\Cars\CarController
     * @throws \Mockery\CountValidator\Exception
     */
    public static function getCategoryControllerByGoods(Goods $goods, Request $request = null)
    {
        switch ($goods->category->code) {
            case 'cars':
                return new \App\Http\Controllers\Goods\Categories\Cars\CarController($goods, $request);
            case 'auto_parts':
                return new \App\Http\Controllers\Goods\Categories\AutoParts\AutoPartController($goods, $request);
            case 'tires':
                return new \App\Http\Controllers\Goods\Categories\Tires\TireController($goods, $request);
            case 'rims':
                return new \App\Http\Controllers\Goods\Categories\Rims\RimController($goods, $request);
            case 'wheels':
                return new \App\Http\Controllers\Goods\Categories\Wheels\WheelController($goods, $request);

            default:
                throw new Exception('No such category ID.');
        }
    }

}
