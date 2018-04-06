<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

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
            'k'
        ];

    /**
     * Get the user record associated with the page.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }

    /**
     * Scope a query to only include active pages.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
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
