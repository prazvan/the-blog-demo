<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Post;
use App\Repositories\Eloquent\PostRepository;
use App\Transformers\v1\PostTransformer;
use Symfony\Component\Finder\Exception\AccessDeniedException;

/**
 * Class PostsController
 * @package App\Http\Controllers\Api\v1
 */
class PostsController extends ApiController
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * PostsController constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Return All Posts paginated
     *
     * @return mixed
     */
    public function index()
    {
        return $this->response->paginator(
            Post::orderBy('id', 'desc')->paginate(6),
            new PostTransformer,
            ['key' => 'posts']
        );
    }

    public function show($id)
    {
        return $this->response->item(
            $this->postRepository->getById($id),
            new PostTransformer,
            ['key' => 'posts']
        );
    }

    public function store()
    {
        //-- for not this method is not allowed
        $this->response->errorMethodNotAllowed();
    }

    public function update()
    {
        //-- for not this method is not allowed
        $this->response->errorMethodNotAllowed();
    }

    public function destroy()
    {
        //-- for not this method is not allowed
        $this->response->errorMethodNotAllowed();
    }

}