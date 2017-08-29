<?php

namespace App\Repositeries;

use App\Post;
use App\Comment;
use Intervention\Image\ImageManager;
use Illuminate\Exception;
use Validator;
use Carbon\Carbon;

class PostRepository
{
    /**
     * Construct the PostRepository object
     *
     * @param  Intervention\Image\ImageManager $image
     * @param \Validator $validator
     * @param  App\Post $post
     */
    public function __construct(Post $post, ImageManager $image, Validator $validator)
    {
        $this->post = $post;
        $this->image = $image;
        $this->validator = $validator;
        $this->saved = "L'article a bien été enregistré.";
        $this->notSaved = "L'article n'a pas été sauvegardé.";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $all = $this->post->allPost();

        $response = count($all) ? ['posts' => $all] : ['Error' => 'No datas available'];

        return response()->json($response);
    }

    /**
     * return a boolean if the var is ok
     *
     * @param $d Variable
     * @return boolean
     */
    private function isOk($d)
    {
        return isset($d) && !empty($d);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {
        $datas = $request->all();
        $response = null;

        if(!$this->isOk($datas["title"]) && !$this->isOk($datas["content"])) {
            $response = "Veuillez remplir tous les champs.";
            return response()->json($response);
        }

        $this->post->title = $datas["title"];
        $this->post->content = $datas["content"];
        $this->post->user_id = $datas["user_id"];

        $fileName = uniqid().'.'.$datas['fileToUpload']->extension();

        try{
            $this->image->make($datas['fileToUpload']->path())->save('../public/upload/posts/'.$fileName);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $post = $this->post->find($id);
        }catch(ModelNotFoundException $modelNotFoundException) {
            return response()->json(['Error' => "Id incorrect"]);
        }

        return response()->json(["post" => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Create an resume of content.
     *
     * @param  $content string
     * @return $content string
     */
    private function makeAbstract($content)
    {
        return substr($content, 0, 100)."...";
    }
}
