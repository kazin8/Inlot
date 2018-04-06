<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    /**
     * The table's name.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * Array of fields for mass associated
     */
    protected $fillable =
        [
            'message',
            'dialog_id',
            'is_read',
            'is_individual',
        ];

    /**
     * The binding handbook.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dialog()
    {
        return $this->belongsTo('App\Dialog', 'dialog_id');
    }

    public function scopeFindById($query, $id)
    {
        return $query->find($id);
    }
}
