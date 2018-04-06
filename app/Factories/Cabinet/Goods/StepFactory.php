<?php

namespace App\Factories\Cabinet\Goods;

use App\Goods;

use App\Interfaces\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;

/**
 * Factory for making of step's controllers.
 *
 * Class StepFactory
 * @package App\Factories\Cabinet\Goods
 */
class StepFactory extends Controller
{

    /**
     * Get the entity of needle step class.
     *
     * @param $categoryDir
     * @param Goods $goods
     * @param Request $request
     * @return mixed
     * @throws \Mockery\CountValidator\Exception
     */
    public static function getCurrentStep($categoryDir, Goods $goods, Request $request)
    {
        switch (StepFactory::$router->current()->parameter('step')) {
            case 2:
                $stepControllerName = "\\App\\Http\\Controllers\\Cabinet\\Goods\\Categories\\" . $categoryDir . "\\Steps\\SecondStepController";
                break;

            case 3:
                $stepControllerName = "\\App\\Http\\Controllers\\Cabinet\\Goods\\Categories\\" . $categoryDir . "\\Steps\\ThirdStepController";
                break;

            case 4:
                $stepControllerName = "\\App\\Http\\Controllers\\Cabinet\\Goods\\Categories\\" . $categoryDir . "\\Steps\\FourthStepController";
                break;

            default:
                $stepControllerName = "\\App\\Http\\Controllers\\Cabinet\\Goods\\Categories\\" . $categoryDir . "\\Steps\\FirstStepController";
                break;
        }

        return new $stepControllerName($goods, $request);
    }

}
