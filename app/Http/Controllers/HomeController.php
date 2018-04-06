<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\Goods\GoodsController as BaseGoodsController;
use App\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $newGoods = \App\Goods::newGoods(20);
        $visitedGoods = BaseGoodsController::getVisitedGoods($request, 3);

        return view('home', compact('newGoods', 'visitedGoods'));
    }

    public function page(Request $request, $slug)
    {
        $data = Page::bySlug($slug)->first();
        return view('pages', compact('data'));
    }
}
