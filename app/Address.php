<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    /**
     * The table's name.
     *
     * @var string
     */
    protected $table = 'addresses';

    /**
     * The ettributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['region_id', 'city_id', 'address', 'postcode', 'description', 'user_id'];

    /**
     * The binding user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function city()
    {
        return $this->belongsTo('App\City');
    }
    
    public function region()
    {
        return $this->belongsTo('App\Region');
    }
    
    public function getCityNameAttribute()
    {
        return $this->city->name;
    }
    
    public function getRegionNameAttribute()
    {
        return $this->region->name;
    }

}
