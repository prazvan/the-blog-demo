<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Helpers\Cacheable;

/**
 * Class EloquentRepository
 * @package App\Repositories\Eloquent
 */
abstract class EloquentRepository
{
    /**
     * Trait for caching queries
     */
    use Cacheable;

    /**
     * Create new instance of self statically.
     *
     * @return static
     */
    public static function make()
    {
        return new static();
    }
}
