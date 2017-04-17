<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MetaData
 * @package App\Models
 */
class MetaData extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'external_id',
        'value',
    ];

    /**
     * A MetaData has many posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasOne('App\Models\Post');
    }

}
