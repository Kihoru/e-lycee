<?php

namespace App\Http\Controllers;

use App\Qcm;
use App\Comment;
use App\User;
use App\Score;
use Illuminate\Http\Request;

class PlatformFrontController extends Controller
{
    public function home() {

        $userNb = User::all()->where('role', '!=', 'teacher')->count();
        $commentNb = Comment::count();
        $qcmNb = Qcm::count();
        // $qcmNb = Qcm::count();
        // $studentNb = User::countStudent();

        return response()->json(['nbUser' => $userNb, 'nbComment' => $commentNb, 'nbQcm' => $qcmNb]);

    }

    public function scoreFromIds(Request $request) {

        $user_id = $request->user_id;
        $qcm_id = $request->qcm_id;

        $score = Score::where('user_id', $user_id)->where('qcm_id', $qcm_id)->first();


        if(!count($score)) {
            return response()->json(['todo' => 'todo']);
        }else if($score->status == 'done'){
            return response()->json(['already' => 'already', 'score' => $score]);
        }

    }
}
