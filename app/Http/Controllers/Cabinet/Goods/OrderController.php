<?php

namespace App\Http\Controllers\Cabinet\Goods;

use App\Order;
use App\Plugins\Pagination;
use Auth;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

class OrderController extends Controller
{
    private $perPage = 30;

    private $paginationAction;

    public function __construct()
    {
        $this->paginationAction = route('cabinet.orders.pagination');
    }

    public function sales()
    {
        $builder = Auth::user()->sales();
        $pagination = new Pagination(clone $builder->getQuery(), 1, $this->perPage);
        $sales = $builder->orderBy('created_at', 'desc')->pagination(1, $this->perPage)->get();
        $salesActive = true;
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return view('cabinet.goods.order.sales', compact('sales', 'salesActive', 'paginationBlock'));
    }

    public function changeStatus(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->status;

        if ($order->save()) {
            $this->sendEmailToCustomerAboutChangingTheStatus($order);

            $builder = Auth::user()->sales();
            $pagination = new Pagination(clone $builder->getQuery(), $request->page, $this->perPage);
            $orders = $builder->orderBy('created_at', 'desc')->pagination(1, $pagination->getPage() * $this->perPage)->get();
            $paginationBlock = $pagination->view($this->paginationAction)->render();

            return Response::json([
                'view' => view('cabinet.goods.order.partials.sales', compact('orders'))->render(),
                'pagination' => $paginationBlock
            ]);
        }

        return response(['message' => 'Произошла ошибка'], 500);
    }

    private function sendEmailToCustomerAboutChangingTheStatus(Order $order)
    {
        Mail::send('goods.emails.change_order_status', ['order' => $order], function($m) use (&$order) {
            $m->to($order->userCustomer->email)->subject('Cтатус заказа под номером ' . $order->id . ' изменен.');
        });
    }

    public function pagination(Request $request)
    {
        if ($request->listCode === 'sales') {
            $builder = Auth::user()->sales();
        } elseif ($request->listCode === 'orders') {
            $builder = Auth::user()->orders();
        }
        $pagination = new Pagination(clone $builder->getQuery(), $request->page, $this->perPage);
        $orders = $builder->orderBy('created_at', 'desc')->pagination($pagination->getPage(), $this->perPage)->get();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('cabinet.goods.order.partials.' . $request->listCode, compact('orders'))->render(),
            'pagination' => $paginationBlock
        ]);
    }

    public function orders()
    {
        $builder = Auth::user()->orders();
        $pagination = new Pagination(clone $builder->getQuery(), 1, $this->perPage);
        $orders = $builder->orderBy('created_at', 'desc')->pagination(1, $this->perPage)->get();
        $ordersActive = true;
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return view('cabinet.goods.order.orders', compact('orders', 'ordersActive', 'paginationBlock'));
    }

}
