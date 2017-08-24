<?php

namespace App\Repositeries;

use App\Post;
use App\Comment;
use Intervention\Image\ImageManager;

class PostRepository
{
    public function __construct(Post $post, ImageManager $image)
    {
        $this->post = $post;
        $this->image = $image;
        $this->saved = "L'article a bien été enregistré.";
        $this->notSaved = "L'article n'a pas été sauvegardé.";
    }

    public function getAll()
    {
        $all = $this->post->allPost();
    }

    public function create($request)
    {
        $datas = $request->all();
        $response = null;

        $this->post->title = $datas["title"];
        $this->post->content = $datas["content"];
        $this->post->user_id = $datas["user_id"];

        dd($datas['fileToUpload']->size());

        $fileName = uniqid().'.'.$datas['fileToUpload']->extension();

        if(! $this->image->make($datas['fileToUpload']->path())->save('../public/upload/posts/'.$fileName)) {
            var_dump('failure');
            die();
        }

        $this->post->url_thumbnail = $fileName;
        $this->post->abstract = $this->makeAbstract($datas["content"]);

        if(!$this->post->save()) {
            $response = ['Error' => $this->notSaved];
        }

        if(is_null($response)) $response = ['Success' => $this->saved];

        return response()->json($response);
    }

    private function makeAbstract($content)
    {
        return substr($content, 0, 100)."...";
    }
}
