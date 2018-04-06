<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsModels extends Model
{
    protected $table = 'goods_models';

    protected $fillable = ['goods_id', 'model_id', 'mark_id'];
}
