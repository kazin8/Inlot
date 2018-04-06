<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HandbookContent extends Model
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
    protected $table = 'handbooks_content';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'handbook_id'];

    /**
     * The binding handbook.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function handbook()
    {
        return $this->belongsTo('App\Handbook');
    }

    public function scopeFindById($query, $id)
    {
        return $query->find($id);
    }
}
