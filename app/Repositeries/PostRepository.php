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
        $datas = $request->all();
        dd($datas);

        //datas contient :

        /**
        * un array avec 3 elements.
        * un objet php avec les informations de l'image
        * le titre
        * le content
        **/
    }
}
