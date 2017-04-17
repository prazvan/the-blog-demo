<?php

namespace App\Services\Parser\Builders;

use App\Models\Status;
use Illuminate\Support\Collection;

use App\Services\Parser\Parser;
use App\Services\Parser\Contracts\ParserContract;

use App\Repositories\Eloquent\AuthorRepository;
use App\Repositories\Eloquent\MetaDataRepository;
use App\Repositories\Eloquent\PostRepository;

/**
 * Class PostBuilder
 *
 * Parse BrndWgn Posts
 *
 * @package App\Services\Parser\Parsers
 */
class PostBuilder extends Parser implements ParserContract
{
    /**
     * Create a new instance of builder
     *
     * @param array $items
     * @return static
     */
    public static function make(array $items = [])
    {
        return new static($items);
    }

    /**
     * @return Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Build an array of Post Models
     *
     * @param Collection $items
     * @return Collection
     */
    public function parse(Collection $items)
    {
        $posts = new Collection();

        // parse posts
        foreach ($items->toArray()['data'] as $item)
        {
            try
            {
                $posts->push($this->getPost($item));
            }
            catch (\Exception $ex)
            {
                // something went wrong, continue loop
                continue;
            }
        }

        return $posts;
    }

    /**
     * Get or create a new Post
     *
     * @param $item
     * @return mixed
     * @throws \ErrorException
     */
    private function getPost($item)
    {
        $PostRepository = PostRepository::make();

        try
        {
            $Post = $PostRepository->getByExternalId($item['id']);
        }
        catch (\Exception $ex)
        {
            // get status id
            $status_id = (int) ($item['status'] == Status::PUBLISHED ?
                Status::PUBLISHED_ID : Status::UNPUBLISHED_ID);

            $attributes = [
                'external_id'   => $item['id'],
                'status_id'     => $status_id,
                'author_id'     => $this->getAuthor($item)->id,
                'meta_data_id'  => $this->getMetaData($item)->id,
                'title'         => $item['title'],
                'slug'          => $item['slug'],
                'excerpt'       => $item['excerpt'],
                'content'       => $item['content'],
            ];

            if (!$PostRepository->newPost($attributes))
            {
                throw new \ErrorException("Can't create Post");
            }

            $Post = $PostRepository->getByExternalId($item['id']);
        }

        return $Post;
    }

    /**
     * Get or crate a new Author
     *
     * @param $item
     * @return Author
     * @throws \ErrorException
     */
    private function getAuthor($item)
    {
        // assuming this is always set :)
        $wagoneer = $item['fieldValues']['data']['journal-details']['wagoneer']['data'][0];

        $AuthorRepository = AuthorRepository::make();

        try
        {
            // try to get the author, in case of exception we need to create a new author
            $Author = $AuthorRepository->getByName($wagoneer['title']);
        }
        catch (\Exception $ex)
        {
            $attributes = [
                'name'          => $wagoneer['title'],
                'description'   => $wagoneer['excerpt']
            ];

            // crate author
            if (! $AuthorRepository->newAuthor($attributes))
            {
                throw new \ErrorException("Can't create Author");
            }

            $Author = $AuthorRepository->getByName($wagoneer['title']);
        }

        return $Author;
    }

    /**
     * Get or crate a new Meta Data
     *
     * @param $item
     * @return mixed
     * @throws \ErrorException
     */
    private function getMetaData($item)
    {
        $MetaDataRepository = MetaDataRepository::make();

        try
        {
            // try to get the meta data, in case of exception we need to create a new meta data item
            $MataData = $MetaDataRepository->getByExternalId($item['id']);
        }
        catch (\Exception $ex)
        {
            // get image
            $thumbnail = $item['fieldValues']['data']['journal-details']['journal-preview-image']['links'][0];

            $attributes = [
                'external_id'   => $item['id'],
                'value'         => json_encode([
                    'thumbnail' => $thumbnail,
                    'meta_title' => $item['meta_title'],
                    'meta_description' => $item['meta_description'],
                    'og_meta_title' => $item['og_meta_title'],
                    'og_meta_description' => $item['og_meta_description'],
                    'og_meta_image' => $item['og_meta_image'],
                    'og_meta_url' => $item['og_meta_url'],
                    'og_meta_author' => $item['og_meta_author'],
                    'og_meta_publisher' => $item['og_meta_publisher'],
                ])
            ];

            // crate meta data
            if (! $MetaDataRepository->newMetaData($attributes))
            {
                throw new \ErrorException("Can't create mata data");
            }

            $MataData = $MetaDataRepository->getByExternalId($item['id']);
        }

        return $MataData;
    }
}