<?php

namespace App;

use App\Http\Controllers\Goods\FilterController;
use App\Http\Controllers\Goods\SortController;
use Illuminate\Database\Eloquent\Model;

class Tire extends Model
{
    protected $fillable = [
        'diameter',
        'seasonality_id',
        'profile_width',
        'profile_height',
        'state_id',
        'producer',
        'model',
    ];

    public function scopeTireList($query)
    {
        return $query->join('goods', 'tires.id', '=', 'goods.item_id')
            ->where('goods.status', Goods::ON_SALE)
            ->where('goods.active', true)
            ->where('goods.category_id', 5)
            ->whereNull('deleted_at')
            ->select('tires.*', 'goods.price', 'goods.name');
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
        return Goods::where('item_id', $this->id)->where('category_id', 5)->first();
    }

    public function getStateAttribute()
    {
        return $this->state_id ? HandbookContent::findById($this->state_id)['name'] : null;
    }

    public function getSeasonalityAttribute()
    {
        return $this->seasonality_id ? HandbookContent::find($this->seasonality_id)['name'] : null;
    }
}
