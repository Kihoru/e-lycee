<?php

namespace App\Repositeries;

use App\Qcm;
use App\Question;
use App\Choice;

class QcmRepositery
{
    public function __construct(Qcm $qcm)
    {
        $this->qcm = $qcm;
    }

    public function getAll()
    {
        $all = $this->qcm->allQcm();

        $response = count($all) ? ['qcms' => $all] : ['error' => 'No datas available'];

        return response()->json($response);
    }

    public function create($request)
    {
        $datas = $request->datas;
        $response = null;

        $this->qcm->title = $datas["title"];
        $this->qcm->class_level = $datas["class_level"];
        $this->qcm->published = 0;

        if(!$this->qcm->save()) {
            $response = ['Error' => "Le qcm n'a pas été sauvegardé."];
        }

        foreach($datas["questions"] as $question) {

            $newQuest = new Question();

            $newQuest->question = $question["question_title"];

            if(!$this->qcm->questions()->save($newQuest)) {
                $response = ['Error' => "Le qcm n'a pas été sauvegardé."];
            }

            foreach($question["choices"] as $choice) {

                $newChoice = new Choice();

                $newChoice->content = $choice["content"];
                $newChoice->valid = $choice["valid"] === true ? 1 : 0;

                if(!$newQuest->choices()->save($newChoice)) {
                    $response = ['Error' => "Le qcm n'a pas été sauvegardé."];
                }
            }
        }

        if(is_null($response)) $response = ['Success' => 'Le qcm à bien été enregistré.'];

        return response()->json($response);
    }

    public function edit($id)
    {
        $qcm = $this->qcm->find($id)->first();

        $qcm->questions = $this->qcm->find($id)->questions()->get();

        foreach($qcm->questions as &$question) {
            $question->choices = Question::find($question->id)->choices()->get();
        }

        return response()->json(['qcm' => $qcm]);
    }

    public function update($datas, $id)
    {
        $toUpdate = $datas;
        $data = $toUpdate["datas"];
        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';
        // die();
        $publish = $toUpdate["changePublished"];
        $response = null;

        $qcm = $this->qcm->find($id);

        $qcm->title = $data["title"];
        $qcm->class_level = $data["class_level"];
        if($publish == true) {
            $qcm->published = $data["published"] == 0 ? 1 : 0;
        }else{
            $qcm->published = $data["published"];
        }

        if(!$qcm->save()) {
            $response = ['Error' => "Le qcm n'a pas été sauvegardé."];
        }

        foreach($data["questions"] as $question) {

            $quest = Question::find($question["id"]);

            $quest->question = $question["question"];

            if(!$quest->save()) {
                $response = ['Error' => "Le qcm n'a pas été sauvegardé."];
            }

            foreach($question["choices"] as $choice) {

                $oldChoice = Choice::find($choice["id"]);

                $oldChoice->content = $choice["content"];
                $oldChoice->valid = $choice["valid"];

                if(!$oldChoice->save()) {
                    $response = ['Error' => "Le qcm n'a pas été sauvegardé."];
                }
            }
        }

        if(is_null($response)) $response = ['Success' => "Le qcm à bien été modifié."];

        return response()->json($response);
    }
}
