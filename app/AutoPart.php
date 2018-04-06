<?php

namespace App;

use App\Http\Controllers\Goods\FilterController;
use App\Http\Controllers\Goods\SortController;
use Illuminate\Database\Eloquent\Model;

class AutoPart extends Model
{
    protected $fillable = ['auto_part_kind_id', 'original_number', 'state_id'];

    public function scopeAutoPartList($query)
    {
        return $query->join('goods', 'auto_parts.id', '=', 'goods.item_id')
            ->where('goods.status', Goods::ON_SALE)
            ->where('goods.active', true)
            ->where('goods.category_id', 3)
            ->whereNull('deleted_at')
            ->select('auto_parts.*', 'goods.price', 'goods.name');
    }

    public function scopeFilter($query, FilterController $filter)
    {
        return $filter->apply($query);
    }

    public function scopeSort($query, SortController $sort)
    {
        return $sort->apply($query);
    }

    public function scopePagination($query, $page = 1, $perPage = 30)
    {
        return $query->skip(($page - 1) * $perPage)->take($perPage);
    }

    public function getGoodsAttribute()
    {
        return Goods::where('item_id', $this->id)->where('category_id', 3)->first();
    }

    public function getStateAttribute()
    {
        return $this->state_id ? HandbookContent::findById($this->state_id)['name'] : null;
    }

    public function getKindAttribute()
    {
        return $this->auto_part_kind_id ? HandbookContent::findById($this->auto_part_kind_id)['name'] : null;
    }

    public function getCarsAttribute()
    {
        if (count($this->goods->goodsModels)) {
            foreach ($this->goods->goodsModels as $goodsModel) {
                $cars[] = Mark::find($goodsModel->mark_id)['name'] . ' ' .
                    CarModel::find($goodsModel->model_id)['name'];
            }
        }

        return isset($cars) ? array_unique($cars) : [];
    }

    public function getMarksAttribute()
    {
        if (count($this->goods->goodsModels)) {
            foreach ($this->goods->goodsModels as $goodsModel) {
                $marks[] = Mark::find(CarModel::find($goodsModel->model_id)['mark_id'])['name'];
            }
        }

        return isset($marks) ? array_unique($marks) : [];
    }
}
