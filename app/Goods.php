<?php

namespace App;

use App\Factories\Common\ModelFactory;
use App\Http\Controllers\Goods\SortController;
use App\Plugins\FileManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\Facades\Image;

class Goods extends Model
{

    use SoftDeletes;

    const FIRST_STEP_ADDITION = 1;
    const SECOND_STEP_ADDITION = 2;
    const THIRD_STEP_ADDITION = 3;
    const FOURTH_STEP_ADDITION = 4;
    const READY_FOR_SALE = 5;
    const ON_SALE = 6;
    const IN_ORDER_PROCESS = 7;

    protected $fillable = [
        'category_id',
        'item_id',
        'status',
        'user_id',
        'name',
        'image',
        'video',
        'region_id',
        'city_id',
        'price',
        'quantum',
        'count',
        'address',
        'comment',
        'delivery_info',
        'payment_requirement',
        'active'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Bounding user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function order()
    {
        return $this->hasMany('App\Order');
    }
    
    public function city()
    {
        return $this->belongsTo('App\City');
    }
    
    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function goodsModels()
    {
        return $this->hasMany('App\GoodsModels', 'goods_id');
    }

    public function gallery()
    {
        return $this->hasMany('App\GoodsGallery');
    }

    /**
     * Return the new goods.
     *
     * @param $query
     * @param null $count
     * @return mixed
     */
    public function scopeNewGoods($query, $count = null)
    {
        $builder = $query->where('status', self::ON_SALE)->where('active', true)->orderBy('created_at', 'desc');

        return $count ? $builder->take($count)->get() : $builder->get();
    }

    /**
     * Return the all goods.
     *
     * @param $query
     */
    public function scopeAll($query)
    {
        return $query->where('status', '>=', Goods::READY_FOR_SALE);
    }

    /**
     * Return the goods on sale.
     *
     * @param $query
     * @return mixed
     */
    public function scopeOnSale($query)
    {
        return $query->where('status', Goods::ON_SALE);
    }

    /**
     * Return the draft goods.
     *
     * @param $query
     * @return mixed
     */
    public function scopeDraft($query)
    {
        return $query->where('status', '<', Goods::READY_FOR_SALE);
    }

    /**
     * Return the deleted goods.
     *
     * @param $query
     * @return mixed
     */
    public function scopeDeleted($query)
    {
        return $query->onlyTrashed();
    }

    public function scopeCountOnSale($query)
    {
        return $query->where('status', Goods::ON_SALE)->count();
    }
    
    public function scopeSearch($query, $searchQuery, $categoryId = null)
    {
        $query = $query->onSale()
            ->where('active', true)
            ->where('name', 'ilike', '%' . mb_strtolower($searchQuery) . '%');
        
        return $categoryId ? $query->where('category_id', $categoryId) : $query;
    }

    public function scopeSort($query, SortController $sort)
    {
        return $sort->apply($query);
    }

    public function scopePagination($query, $page = 1, $perPage = 30)
    {
        return $query->skip(($page - 1) * $perPage)->take($perPage);
    }

    public function getUnitAttribute()
    {
        return ModelFactory::getModelByGoods($this);
    }

    public function getCompanyNameAttribute()
    {
        return $this->user->company ? $this->user->company->name : null;
    }

    public function getFullImagePathAttribute()
    {
        return FileManager::getFileName($this->image, $this->imagesDir) ?: '/static/default/no-thumb.png';
    }
    
    public function getImagePathAttribute()
    {
        return FileManager::getFileName('mini_' . $this->image, $this->imagesDir) ?: '/static/default/no-thumb.png';
    }

    public function getFullImagePathEmpty()
    {
        return FileManager::getFileName($this->image, $this->imagesDir);
    }

    public function getImagePathEmpty()
    {
        return FileManager::getFileName('mini_' . $this->image, $this->imagesDir);
    }
    
    public function getPriceFormatAttribute()
    {
        return number_format($this->price, 0, '', ' ');
    }

    public function getImagesDirAttribute()
    {
        return '/goods/' . $this->id . '/';
    }

    public function getQuantumListAttribute()
    {
        return HintList::getQuantumList();
    }

    public function setImageAttribute($value)
    {
        if ($value !== $this->image) {
            FileManager::deleteFile($this->image, $this->imagesDir);
            FileManager::deleteFile('mini_' . $this->image, $this->imagesDir);

            if ($value) {
                $img = Image::make('static' . $this->imagesDir . $value);
                $img->resize(null, 150, function($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save('static' . $this->imagesDir . 'mini_' . $img->basename);
            }
        }

        $this->attributes['image'] = $value;
    }



}