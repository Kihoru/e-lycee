<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Qcm;
use App\Question;
use App\Choice;

class QcmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Qcm::with('question.choice')->get();

        if(count($all)) {
            return response()->json(['qcms' => $all]);
        }else{
            return response()->json(['error' => 'No datas available']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $qcm = new Qcm();

        $datas = $request->datas;

        $qcm->title = $datas["title"];
        $qcm->class_level = $datas["class_level"];
        $qcm->published = 0;

        if(!$qcm->save()) {
            return response()->json(['Error' => "Le qcm n'a pas été sauvegardé."]);
        }

        foreach($datas["questions"] as $question) {

            $newQuest = new Question();

            $newQuest->question = $question["question_title"];

            if(!$qcm->question()->save($newQuest)) {
                return response()->json(['Error' => "Le qcm n'a pas été sauvegardé."]);
            }

            foreach($question["choices"] as $choice) {

                $newChoice = new Choice();

                $newChoice->content = $choice["content"];
                $newChoice->valid = $choice["valid"] === true ? 1 : 0;

                if(!$newQuest->choice()->save($newChoice)) {
                    return response()->json(['Error' => "Le qcm n'a pas été sauvegardé."]);
                }
            }

        }

        return response()->json(['Success' => 'Le qcm à bien été enregistré.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $qcm = Qcm::find($id);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $toUpdate = $request->all();
        $data = $toUpdate["datas"];
        $publish = $toUpdate["changePublished"];

        $qcm = Qcm::find($id);

        $qcm->title = $data["title"];
        $qcm->class_level = $data["class_level"];
        if($publish == true) {
            $qcm->published = $data["published"] == 0 ? 1 : 0;
        }else{
            $qcm->published = $data["published"];
        }

        if(!$qcm->save()) {
            return response()->json(['Error' => "Le qcm n'a pas été sauvegardé."]);
        }

        foreach($data["question"] as $question) {

            $quest = Question::find($question["id"]);

            $quest->question = $question["question"];

            if(!$quest->save()) {
                return response()->json(['Error' => "Le qcm n'a pas été sauvegardé."]);
            }

            foreach($question["choice"] as $choice) {

                $oldChoice = Choice::find($choice["id"]);

                $oldChoice->content = $choice["content"];
                $oldChoice->valid = $choice["valid"];

                if(!$oldChoice->save()) {
                    return response()->json(['Error' => "Le qcm n'a pas été sauvegardé."]);
                }
            }
        }

        return response()->json(['Success' => "Le qcm à bien été modifié."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
