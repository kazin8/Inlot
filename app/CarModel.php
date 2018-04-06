<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $connection = 'pgsql_classifier';

    protected $table = 'models';

    public function scopeFindById($query, $id)
    {
        return $query->find($id);
    }

}
