<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpPage extends Model
{

    /**
     * The table's name.
     *
     * @var string
     */
    protected $table = 'help_page';

    /**
     * Array of fields for mass associated
     */
    protected $fillable =
        [
            'name',
            'full_text',
            'slug',
            't',
            'd',
            'k',
            'pid',
            'ord',
            'active'
        ];

    /**
     * The binding handbook.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo('App\HelpCategory', 'pid');
    }

    public function scopeFindById($query, $id)
    {
        return $query->find($id);
    }

    /**
     * Scope a query to only include active pages.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}
