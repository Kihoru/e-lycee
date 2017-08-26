<?php

namespace App\Repositeries;

use App\Qcm;
use App\Question;
use App\Choice;
use App\Score;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class QcmRepository
{
    public function __construct(Qcm $qcm)
    {
        $this->saved = ['Success' => 'Le qcm à bien été enregistré.'];
        $this->notSaved = ['Error' => "Le qcm n'a pas été sauvegardé."];
        $this->error = ["Error" => "Veuillez remplir le formulaire correctement"];
        $this->qcm = $qcm;
    }

    public function getAll()
    {
        $all = $this->qcm->allQcm();

        $response = count($all) ? ['qcms' => $all] : ['Error' => 'No datas available'];

        return response()->json($response);
    }

    public function getAllFromStudent($request)
    {
        $id = $request->only("user_id");
        $user_id = $id["user_id"];

        $count = Score::where('user_id', $user_id)->count();

        if($count) {
            $res = DB::select(DB::raw("SELECT q.*, count(qu.question) as nbQuestion, s.note FROM qcms as q INNER JOIN questions as qu on qu.qcm_id = q.id LEFT JOIN scores as s on s.qcm_id = q.id WHERE s.user_id = $user_id GROUP BY q.id"));
            $ids = array();
            foreach($res as $r) {
                array_push($ids, $r->id);
            }

            $allQcms = $this->qcm->allQcm();
            $i = 0;
            foreach($allQcms as $qcm) {
                if(in_array($qcm->id, $ids)) {
                    unset($allQcms[$i]);
                }else{
                    array_push($res, $allQcms[$i]);
                }
                $i++;
            }
        }else{
            $res = $this->qcm->allQcm();
        }

        return $res;
    }

    public function create($request)
    {
        $datas = $request->datas;
        $response = null;

        if($this->isOk($datas['title']) && $this->isOk($datas['class_level'])) {
            $this->qcm->title = htmlspecialchars($datas["title"]);
            $this->qcm->class_level = htmlspecialchars($datas["class_level"]);
        }else{
            return response()->json($this->error);
        }

        $this->qcm->published = 0;

        if(!$this->qcm->save()) {
            $response = $this->notSaved;
        }

        foreach($datas["questions"] as $question) {

            $newQuest = new Question();

            if($this->isOk($question["question_title"])) {
                $newQuest->question = htmlspecialchars($question["question_title"]);
            }else{
                return response()->json($this->error);
            }


            if(!$this->qcm->questions()->save($newQuest)) {
                $response = $this->notSaved;
            }

            foreach($question["choices"] as $choice) {

                $newChoice = new Choice();

                if($this->isOk($choice["content"])) {
                    $newChoice->content = htmlspecialchars($choice["content"]);
                }else{
                    return response()->json($this->error);
                }
                $newChoice->valid = $choice["valid"] === true ? 1 : 0;

                if(!$newQuest->choices()->save($newChoice)) {
                    $response = $this->notSaved;
                }
            }
        }

        if(is_null($response)) $response = $this->saved;

        return response()->json($response);
    }

    public function update($datas, $id)
    {
        $toUpdate = $datas;
        $data = $toUpdate["datas"];

        $publish = isset($toUpdate["changePublished"]) ? $toUpdate["changePublished"] : false;
        $response = null;

        $qcm = $this->qcm->find($id);

        if($this->isOk($data['title']) && $this->isOk($data['class_level'])) {
            $qcm->title = htmlspecialchars($data["title"]);
            $qcm->class_level = htmlspecialchars($data["class_level"]);
        }else{
            return response()->json($this->error);
        }

        if($publish == true) {
            $qcm->published = $data["published"] == 0 ? 1 : 0;
        }else{
            $qcm->published = $data["published"];
        }

        if(!$qcm->save()) {
            $response = $this->notSaved;
        }

        foreach($data["questions"] as $question) {

            $quest = Question::find($question["id"]);

            if($this->isOk($question["question"])) {
                $quest->question = htmlspecialchars($question["question"]);
            }else{
                return response()->json($this->error);
            }

            if(!$quest->save()) {
                $response = $this->notSaved;
            }

            foreach($question["choices"] as $choice) {

                $oldChoice = Choice::find($choice["id"]);

                if($this->isOk($choice["content"])) {
                    $oldChoice->content = htmlspecialchars($choice["content"]);
                }else{
                    return response()->json($this->error);
                }
                $oldChoice->valid = $choice["valid"];

                if(!$oldChoice->save()) {
                    $response = $this->notSaved;
                }
            }
        }

        if(is_null($response)) $response = $this->saved;

        return response()->json($response);
    }

    public function edit($id)
    {
        try{
            $qcm = $this->qcm->findOrFail($id);
        }catch(ModelNotFoundException $modelNotFoundException) {
            return response()->json(['Error' => "Id incorrect"]);
        }

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

        $isAlreadyScored = Score::where('user_id', $datas['user_id'])->where('qcm_id', $datas['qcm_id'])->count();

        if(!$isAlreadyScored) {
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
        }else{
            $response = ['Error' => "Vous avez déjà répondu à ce qcm."];
        }

        return response()->json($response);
    }

    private function isOk($var)
    {
        return isset($var) && !empty($var);
    }
}
