<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    /**
     * The connection's name.
     *
     * @var string
     */
    protected $connection = 'pgsql_classifier';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The binding country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    /**
     * The cities of this region.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany('App\City');
    }

    public function scopeFindById($query, $id)
    {
        return $query->find($id);
    }

}
