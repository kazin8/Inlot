<?php

namespace App\Factories\Common;

use App\AutoPart;
use App\Car;
use App\Goods;
use App\Rim;
use App\Tire;
use App\Wheel;
use Mockery\CountValidator\Exception;

class ModelFactory
{

    public static function getModelByGoods(Goods $goods)
    {
        switch ($goods->category->code) {
            case 'cars':
                return Car::findOrFail($goods->item_id);
            case 'auto_parts':
                return AutoPart::findOrFail($goods->item_id);
            case 'tires':
                return Tire::findOrFail($goods->item_id);
            case 'rims':
                return Rim::findOrFail($goods->item_id);
            case 'wheels':
                return Wheel::findOrFail($goods->item_id);
            default:
                throw new Exception('No such model.');
        }
    }

}