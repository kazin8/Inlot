<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpCategory extends Model
{

    /**
     * The table's name.
     *
     * @var string
     */
    protected $table = 'help_category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'ord',
        'active',
        'slug'
    ];

    /**
     * The records of this handbook.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany('App\HelpPage', 'pid');
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
