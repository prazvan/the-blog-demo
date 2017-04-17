<?php

namespace App\Repositories\Eloquent;

use App\Models\Author;

/**
 * Class AuthorRepository
 * @package App\Repositories\Eloquent
 */
final class AuthorRepository extends EloquentRepository
{
    /**
     * @param $name
     * @return mixed
     */
    public function getByName($name)
    {
        return $this->cacheQuery('Author_' . $name, function () use ($name) {
            return Author::where('name', $name)->firstOrFail();
        });
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function newAuthor(array $attributes = [])
    {
        return (new Author)->fill($attributes)->save();
    }
}