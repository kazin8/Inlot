<?php

namespace App;

use App\Http\Controllers\Goods\FilterController;
use App\Http\Controllers\Goods\SortController;
use Illuminate\Database\Eloquent\Model;

class Rim extends Model
{
    protected $fillable = [
        'rim_type_id',
        'diameter',
        'width',
        'number_of_holes',
        'hole_diameter_id',
        'radius_id',
        'state_id',
    ];

    public function scopeRimList($query)
    {
        return $query->join('goods', 'rims.id', '=', 'goods.item_id')
            ->where('goods.status', Goods::ON_SALE)
            ->where('goods.active', true)
            ->where('goods.category_id', 6)
            ->whereNull('deleted_at')
            ->select('rims.*', 'goods.price', 'goods.name');
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
        return Goods::where('item_id', $this->id)->where('category_id', 6)->first();
    }

    public function getStateAttribute()
    {
        return $this->state_id ? HandbookContent::findById($this->state_id)['name'] : null;
    }

    public function getTypeAttribute()
    {
        return $this->rim_type_id ? HandbookContent::findById($this->rim_type_id)['name'] : null;
    }

    public function getHoleDiameterAttribute()
    {
        return $this->hole_diameter_id ? HandbookContent::findById($this->hole_diameter_id)['name'] : null;
    }

    public function getRadiusAttribute()
    {
        return $this->radius_id ? HandbookContent::findById($this->radius_id)['name'] : null;
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
}
