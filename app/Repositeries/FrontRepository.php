<?php

namespace App\Repositeries;

use App\Post;
use App\Comment;

class FrontRepository
{
    public function __construct(Post $post, Comment $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
    }
}
