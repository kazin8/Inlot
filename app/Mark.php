<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{

    protected $connection = 'pgsql_classifier';

    public function scopeFindById($query, $id)
    {
        return $query->find($id);
    }

}
