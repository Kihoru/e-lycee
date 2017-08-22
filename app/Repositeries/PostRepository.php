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
        $datas = $request->datas;
        $response = null;

        $this->post->title = $datas["title"];
        $this->post->abstract = $datas["abstract"];
        $this->post->content = $datas["content"];
        $this->post->thumbnail = $datas["thumbnail"];

        if(!$this->post->save()) {
            $response = ['Error' => "L'article n'a pas été sauvegardé."];
        }else {
            $response = ['Success' => 'L\'article a bien été sauvegardé.'];
        }

        return response()->json($response);
    }
}