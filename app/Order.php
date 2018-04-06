<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_NEW = 1;
    const STATUS_AWAITING_PAYMENT = 2;
    const STATUS_PAID = 3;
    const STATUS_COMPLETED = 4;
    const STATUS_CANCELED = 5;

    public static $statusNamesOwner = [
        self::STATUS_NEW => 'Новый',
        self::STATUS_AWAITING_PAYMENT => 'Принят, в ожидании оплаты',
        self::STATUS_PAID => 'Оплачен',
        self::STATUS_COMPLETED => 'Выполнен',
        self::STATUS_CANCELED => 'Отменен'
    ];

    public static $statusNamesCustomer = [
        self::STATUS_NEW => 'Ожидает подтверждения',
        self::STATUS_AWAITING_PAYMENT => 'Принят, в ожидании оплаты',
        self::STATUS_PAID => 'Оплачен',
        self::STATUS_COMPLETED => 'Выполнен',
        self::STATUS_CANCELED => 'Отменен'
    ];

    protected $fillable = ['goods_id', 'user_id', 'user_owner_id', 'comment', 'status'];

    public function goods()
    {
        return $this->belongsTo('App\Goods');
    }

    public function userCustomer()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function userOwner()
    {
        return $this->belongsTo('App\User', 'user_owner_id');
    }

    public function scopePagination($query, $page = 1, $perPage = 30)
    {
        return $query->skip(($page - 1) * $perPage)->take($perPage);
    }
    
    public function getDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d.m.Y');
    }

}
