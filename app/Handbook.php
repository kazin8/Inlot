<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Handbook extends Model
{

    /**
     * Connection's name.
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
     * The records of this handbook.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function records()
    {
        return $this->hasMany('App\HandbookContent');
    }

}
