<?php

namespace App\Transformers\v1;

use App\Models\Post;
use League\Fractal\TransformerAbstract;

/**
 * Class PostTransformer
 * @package App\Transformers\v1
 */
class PostTransformer extends TransformerAbstract
{
    /**
     * List of resource possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [
        'status',
        'meta_data',
    ];

    /**
     * Post Transformer
     * example of a custom transformer for the api :)
     *
     * @param Post $Post
     * @return array
     */
    public function transform(Post $Post)
    {
        $meta_data = $Post->meta_data()->firstOrFail();

        // this are the visible values in the "attributes" section of the response
        return  [
            'id' => $Post->id,
            'external_id' => $Post->external_id,
            'status_id' => $Post->status_id,
            'author_id' => $Post->author_id,
            'meta_data_id' => $Post->meta_data_id,
            'title' => $Post->title,
            'excerpt' => $Post->excerpt,
            'created_at' => $Post->created_at,
            'author' => $Post->author()->firstOrFail(),
            'meta_data' => json_decode($meta_data->value)
        ];
    }

    /**
     * @param Post $Post
     * @return \League\Fractal\Resource\Item
     */
    public function includeStatus(Post $Post)
    {
        return $this->item($Post->status()->firstOrFail(), new StatusTransformer, 'status');
    }

    /**
     * @param Post $Post
     * @return \League\Fractal\Resource\Item
     */
    public function includeMetaData(Post $Post)
    {
        return $this->item($Post->meta_data()->firstOrFail(), new MetadataTransformer, 'meta_data');
    }
}