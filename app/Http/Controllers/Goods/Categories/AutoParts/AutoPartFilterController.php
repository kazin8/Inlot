<?php

namespace App\Http\Controllers\Goods\Categories\AutoParts;

use App\Category;
use App\Goods;
use App\GoodsModels;
use App\Http\Controllers\Goods\FilterController;
use Illuminate\Http\Request;

use App\Http\Requests;

class AutoPartFilterController extends FilterController
{

    public function originalNumber($originalNumber = null)
    {
        return $originalNumber ? $this->builder->where('original_number', $originalNumber) : $this->builder;
    }

    public function kind($kindId = null)
    {
        return $kindId ? $this->builder->where('auto_part_kind_id', $kindId) : $this->builder;
    }

    public function marks($markIds = null)
    {
        if ($markIds) {
            $goods = Category::where('code', 'auto_parts')
                ->first()
                ->goods()
                ->where('status', Goods::ON_SALE)
                ->where('active', true)
                ->get();

            $goodsIds = [];

            if (count($goods)) {
                foreach ($goods as $product) {
                    $goodsIds[] = $product->id;
                }
            }

            $goodsModels = GoodsModels::whereIn('mark_id', $markIds)->whereIn('goods_id', $goodsIds)->get();

            $goodsIds = [];

            if (count($goodsModels)) {
                foreach ($goodsModels as $goodsModel) {
                    $goodsIds[] = $goodsModel->goods_id;
                }
            }

            return $this->builder->whereIn('goods.id', $goodsIds);
        }

        return $this->builder;
    }

    public function models($modelIds = null)
    {
        if ($modelIds) {
            $goods = Category::where('code', 'auto_parts')
                ->first()
                ->goods()
                ->where('status', Goods::ON_SALE)
                ->where('active', true)
                ->get();

            $goodsIds = [];
            if (count($goods)) {
                foreach ($goods as $product) {
                    $goodsIds[] = $product->id;
                }
            }

            $goodsModels = GoodsModels::whereIn('model_id', $modelIds)->whereIn('goods_id', $goodsIds)->get();

            $goodsIds = [];
            if (count($goodsModels)) {
                foreach ($goodsModels as $goodsModel) {
                    $goodsIds[] = $goodsModel->goods_id;
                }
            }

            return $this->builder->whereIn('goods.id', $goodsIds);
        }

        return $this->builder;
    }

    public function state($stateId = null)
    {
        return $stateId ? $this->builder->where('state_id', $stateId) : $this->builder;
    }

}
