<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;

/**
 * Class PostRepository
 * @package App\Repositories\Eloquent
 */
final class PostRepository extends EloquentRepository
{
    /**
     * @param $external_id
     * @return mixed
     */
    public function getByExternalId($external_id)
    {
        return $this->cacheQuery('post_' . $external_id, function () use ($external_id) {
            return Post::where('external_id', $external_id)->firstOrFail();
        });
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->cacheQuery('post_' . $id, function () use ($id) {
            return Post::where('id', $id)->firstOrFail();
        });
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function newPost(array $attributes = [])
    {
        return (new Post)->fill($attributes)->save();
    }

    /**
     * Get All Posts
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->cacheQuery('all_posts', function () {
            return Post::all()->orderBy('id', 'desc');
        });
    }
}