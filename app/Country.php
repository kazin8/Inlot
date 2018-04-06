<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    /**
     * THe connection's name.
     *
     * @var string
     */
    protected $connection = 'pgsql_classifier';

    /**
     * The table's name.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * The attributes that are mass fillable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The regions of this country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regions()
    {
        return $this->hasMany('App\Region');
    }

}
