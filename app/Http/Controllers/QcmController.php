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
        $all = Qcm::all();
        //
        // foreach($all as $qcm) {
        //     $qcm->questions = Question::find($qcm->id);
        // }

        return response()->json(['qcms' => $all]);
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

        echo "<pre>";
        var_dump($datas);
        echo "</pre>";
        die();

        $qcm->title = $datas["title"];
        $qcm->class_level = $datas["class_level"];

        $qcm->save();

        foreach($datas["questions"] as $question) {

            $newQuest = new Question();

            $newQuest->question = $question["question_title"];

            $qcm->question()->save($newQuest);

            foreach($question["choices"] as $choice) {

                $newChoice = new Choice();

                $newChoice->content = $choice["content"];
                $newChoice->valid = $choice["valid"] === true ? 1 : 0;

                $qcm->question()->choice()->save($newChoice);
            }

        }

        return response()->json(['Test' => 'Hello']);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
