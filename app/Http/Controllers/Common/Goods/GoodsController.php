<?php

namespace App\Http\Controllers\Common\Goods;

use App\Order;
use Auth;
use App\Factories\Common\CategoryFactory;
use App\Goods;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    protected $paginationAction;

    public function __construct(Request $request = null)
    {
        $this->paginationAction = route('cabinet.goods.pagination');
    }

    /**
     * Activate the product.
     *
     * @param Goods $goods
     * @return bool
     */
    public function activate(Goods $goods)
    {
        $goods->status = Goods::ON_SALE;

        return $goods->save() ? true : false;
    }

    /**
     * Disactivate the product.
     *
     * @param Goods $goods
     * @return bool
     */
    public function disactivate(Goods $goods)
    {
        $goods->status = Goods::READY_FOR_SALE;

        return $goods->save() ? true : false;
    }

    /**
     * Order the product.
     *
     * @param Goods $goods
     * @return bool
     */
    public function order(Goods $goods)
    {
        if ($goods->category->code === 'cars' or $goods->count === 1) {
            $goods->status = Goods::IN_ORDER_PROCESS;

            return $goods->save() ? true : false;
        }

        return true;
    }

    /**
     * Destroy the product.
     *
     * @param Goods $goods
     * @return bool
     */
    protected function destroy(Goods $goods)
    {
        return $goods->delete() ? true : false;
    }

    /**
     * Restore the product.
     *
     * @param $id
     * @return bool
     */
    protected function restore($id)
    {
        return Goods::where('id', $id)->restore() ? true : false;
    }

    /**
     * Change the goods status.
     *
     * @param Goods $goods
     * @param $status
     */
    public function changeStepStatus(Goods $goods, $status)
    {
        if ($goods->status < $status) {
            $goods->status = $status;

            $goods->save();
        }
    }

    public function isAvailableForViewing(Goods $goods)
    {
        if (($goods->status === Goods::ON_SALE and $goods->active) or
            ($goods->status === Goods::IN_ORDER_PROCESS and
                Order::where(['goods_id' => $goods->id, 'user_id' => Auth::user()->id])
                    ->orWhere(['goods_id' => $goods->id, 'user_owner_id' => Auth::user()->id])
                    ->count())
        ) {
            return true;
        }

        return false;
    }

    /**
     * Get the goods which marked as visited.
     *
     * @param Request $request
     * @param null $count
     * @return array
     */
    public static function getVisitedGoods(Request $request, $count = null)
    {
        $goods = (new self())->getActiveVisitedGoods($request);
        $goods = $count ? array_slice(array_reverse($goods), 0, $count) : array_reverse($goods);

        return $goods;
    }

    private function getActiveVisitedGoods(Request $request)
    {
        $key = Auth::check() ? 'visitedGoods.' . Auth::user()->id : 'visitedGoods.noneAuth';
        $goods = $request->session()->get($key, []);
        $data = [];

        if ($goods) {
            foreach ($goods as $product) {
                $product = Goods::find($product->id);
                if ($product and $product->status == Goods::ON_SALE and $product->active) {
                    $data[] = $product;
                }
            }
        }

        return $data;
    }

}
