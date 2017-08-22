<?php

namespace App\Repositeries;

use App\Qcm;
use App\Question;
use App\Choice;
use App\Score;

class QcmRepository
{
    public function __construct(Qcm $qcm)
    {
        $this->saved = 'Le qcm à bien été enregistré.';
        $this->notSaved = "Le qcm n'a pas été sauvegardé.";
        $this->qcm = $qcm;
    }

    public function getAll()
    {
        $all = $this->qcm->allQcm();

        $response = count($all) ? ['qcms' => $all] : ['Error' => 'No datas available'];

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
            $response = ['Error' => $this->notSaved];
        }

        foreach($datas["questions"] as $question) {

            $newQuest = new Question();

            $newQuest->question = $question["question_title"];

            if(!$this->qcm->questions()->save($newQuest)) {
                $response = ['Error' => $this->notSaved];
            }

            foreach($question["choices"] as $choice) {

                $newChoice = new Choice();

                $newChoice->content = $choice["content"];
                $newChoice->valid = $choice["valid"] === true ? 1 : 0;

                if(!$newQuest->choices()->save($newChoice)) {
                    $response = ['Error' => $this->notSaved];
                }
            }
        }

        if(is_null($response)) $response = ['Success' => $this->saved];

        return response()->json($response);
    }

    public function update($datas, $id)
    {
        $toUpdate = $datas;
        $data = $toUpdate["datas"];

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
            $response = ['Error' => $this->notSaved];
        }

        foreach($data["questions"] as $question) {

            $quest = Question::find($question["id"]);

            $quest->question = $question["question"];

            if(!$quest->save()) {
                $response = ['Error' => $this->notSaved];
            }

            foreach($question["choices"] as $choice) {

                $oldChoice = Choice::find($choice["id"]);

                $oldChoice->content = $choice["content"];
                $oldChoice->valid = $choice["valid"];

                if(!$oldChoice->save()) {
                    $response = ['Error' => $this->notSaved];
                }
            }
        }

        if(is_null($response)) $response = ['Success' => $this->saved];

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

    public function delete($id)
    {
        $qcm = $this->qcm->find($id);
        $response = '';
        if(!$qcm->delete()) {
            $response = ["Error" => "Le qcm n'a pas pu être supprimé"];
        }else{
            $response = ["Success" => "Le Qcm a bien été supprimé"];
        }

        return response()->json($response);
    }

    public function one($id)
    {
        $qcm = $this->qcm->getOne($id);

        $response = count($qcm) ? ["qcm" => $qcm] : ["Error" => "Aucun qcm trouvé à cette id"];

        return response()->json($response);
    }

    public function addScore($request)
    {
        $datas = $request->all();

        $score = new Score();

        $score->user_id = $datas['user_id'];
        $score->qcm_id = $datas['qcm_id'];
        $score->status = $datas['status'];
        $score->note = $datas['note'];

        if(!$score->save()) {
            $response = ['Error' => "Le score n'a pas pu être validé."];
        }else{
            $response = ['Success' => "Le qcm a bien été validé."];
        }

        return response()->json($response);
    }
}
