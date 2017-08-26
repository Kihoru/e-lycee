<?php

namespace App\Repositeries;

use App\Post;
use App\Comment;
use Intervention\Image\ImageManager;
use Illuminate\Exception;

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

        $response = count($all) ? ['posts' => $all] : ['Error' => 'No datas available'];

        return response()->json($response);
    }

    public function create($request)
    {
        $datas = $request->all();
        $response = null;

        $this->post->title = $datas["title"];
        $this->post->content = $datas["content"];
        $this->post->user_id = $datas["user_id"];

        $fileName = uniqid().'.'.$datas['fileToUpload']->extension();

        try{
            $this->image->make($datas['fileToUpload']->path())->save('/public/upload/posts/'.$fileName);
        }catch(Exception $exception){
            return response()->json(['Error' => 'Votre image est trop lourde, veuillez en selectionner une de moins de 2MO']);
        }

        $this->post->url_thumbnail = $fileName;
        $this->post->abstract = $this->makeAbstract($datas["content"]);

        if(!$this->post->save()) {
            $response = ['Error' => $this->notSaved];
        }

        if(is_null($response)) $response = ['Success' => $this->saved];

        return response()->json($response);
    }

    public function update($request, $id)
    {
        $toUpdate = $request->all();
        $data = $toUpdate["datas"];

        $publish = isset($toUpdate["changePublished"]) ? $toUpdate["changePublished"] : false;
        $response = null;

        $post = $this->post->find($id);

        if($publish == true) {
            $post->status = $data["status"] == 0 ? 1 : 0;
            $post->save();

            return response()->json(["Success" => "Status bien changé."]);
        }else{
            $post->status = $data["status"];
        }

        $post->title = $data["title"];
        $post->abstract = $data["abstract"];
        $post->content = $data["content"];

        if(!$post->save()) {
            $response = ["Error" => "Les modifications n'ont pas été sauvegardées."];
        }else{
            $response = ["Success" => "Les modifications ont bien été enregistrées"];
        }

        return response()->json($response);
    }

    public function edit($id)
    {
        try{
            $post = $this->post->find($id);
        }catch(ModelNotFoundException $modelNotFoundException) {
            return response()->json(['Error' => "Id incorrect"]);
        }

        return response()->json(["post" => $post]);
    }

    public function delete($id)
    {
        $post = $this->post->find($id);
        $response = null;
        if(!$post->delete()) {
            $response = ["Error" => "Le qcm n'a pas pu être supprimé"];
        }else{
            $response = ["Success" => "Le Qcm a bien été supprimé"];
        }

        return response()->json($response);
    }

    private function makeAbstract($content)
    {
        return substr($content, 0, 100)."...";
    }
}
