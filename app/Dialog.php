<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{

    /**
     * The table's name.
     *
     * @var string
     */
    protected $table = 'dialogs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entity_id',
        'individual_id',
        'good_id',
        'is_entity_deleted',
        'is_individual_deleted',
    ];

    /**
     * The records of this handbook.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('App\Message', 'dialog_id');
    }

    /**
     * The binding handbook.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function individual()
    {
        return $this->belongsTo('App\User', 'individual_id');
    }

    /**
     * The binding handbook.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entity()
    {
        return $this->belongsTo('App\User', 'entity_id');
    }

    /**
     * The binding handbook.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function good()
    {
        return $this->belongsTo('App\Goods', 'good_id');
    }

}
