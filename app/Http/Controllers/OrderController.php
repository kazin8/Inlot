<?php

namespace App\Http\Controllers;

use App;
use Auth;
use App\Order;

use App\Http\Requests;

class OrderController extends Controller
{
    public function view(Order $order)
    {
        return ($order->user_id === Auth::User()->id or $order->user_owner_id === Auth::user()->id) ?
            view('orders.item', compact('order')) :
            App::abort(404);;
    }
}
