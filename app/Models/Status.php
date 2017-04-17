<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * @package App\Models
 */
class Status extends Model
{
    /**
     * statuses name
     */
    const PUBLISHED = 'published';
    const UNPUBLISHED = 'unpublished';

    /**
     * statuses ids
     */
    const PUBLISHED_ID = 1;
    const UNPUBLISHED_ID = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * A status has many posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
}
