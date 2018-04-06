<?php

namespace App\Http\Controllers\Goods;

use App;
use App\Factories\Goods\CategoryFactory;
use App\Goods;
use App\Order;
use Auth;
use Mail;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    protected $goodsController;

    public function __construct()
    {
        $this->goodsController = new GoodsController();
    }

    public function view(Goods $goods)
    {
        if ($goods->status == Goods::ON_SALE) {
            return view('goods.order', compact('goods'));
        }

        return App::abort(404);
    }

    public function order(Goods $goods, Request $request)
    {
        if (!$this->goodsController->isAvailableForViewing($goods)) {
            return redirect()->route('cabinet.orders');
        }
        $order = $this->create($goods, $request);
        $this->goodsController->order($goods);
        $this->sendEmailAboutSuccessOrderToOwner($goods);

        return view('goods.after_order', compact('order'));
    }

    private function create(Goods $goods, Request $request)
    {
        return Order::create([
            'goods_id' => $goods->id,
            'user_id' => Auth::user()->id,
            'user_owner_id' => $goods->user->id,
            'comment' => $request->input('comment'),
            'status' => 1
        ]);
    }

    private function sendEmailAboutSuccessOrderToOwner(Goods $goods)
    {
        Mail::send('goods.emails.order', [], function($m) use(&$goods) {
            $m->to($goods->user->email)->subject('Заказ товара!');
        });
    }

}