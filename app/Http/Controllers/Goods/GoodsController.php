<?php

namespace App\Http\Controllers\Goods;

use App\Factories\Goods\CategoryFactory;
use App;
use Auth;
use Mail;
use App\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\Goods\GoodsController as BaseGoodsController;
use App\Http\Requests;

class GoodsController extends BaseGoodsController
{

    /**
     * Marks the goods as visited.
     *
     * @param Request $request
     * @param Goods $goods
     */
    public function setVisitedGoods(Request $request, Goods $goods)
    {
        $key = Auth::check() ? 'visitedGoods.' . Auth::user()->id : 'visitedGoods.noneAuth';

        if ($request->session()->has($key . '.' . $goods->id)) {
            $request->session()->forget($key . '.' . $goods->id);
        }

        $request->session()->put($key . '.' . $goods->id, $goods);
    }

}