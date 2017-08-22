<?php

namespace App\Repositeries;

use App\Post;
use App\Comment;

class PostRepository
{
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll()
    {
        $all = $this->post->allPost();
    }

    public function create($request)
    {
        
    }
}