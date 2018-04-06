<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    /**
     * The connection's name.
     *
     * @var string
     */
    protected $connection = 'pgsql_classifier';

    /**
     * The table's name.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The binding region.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function scopeFindById($query, $id)
    {
        return $query->findOrNew($id);
    }

}
