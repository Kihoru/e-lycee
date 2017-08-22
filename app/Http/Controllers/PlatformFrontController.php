<?php

namespace App\Http\Controllers;

use App\Qcm;
use App\Comment;
use App\User;
use App\Score;
use Illuminate\Http\Request;

class PlatformFrontController extends Controller
{
    public function home()
    {

        $userNb = User::all()->where('role', '!=', 'teacher')->count();
        $commentNb = Comment::count();
        $qcmNb = Qcm::count();

        return response()->json(['nbUser' => $userNb, 'nbComment' => $commentNb, 'nbQcm' => $qcmNb]);

    }

    public function homeStudent(Request $request)
    {
        $user_id = $request->only('user_id');

        $totalScore = Score::getTotalScore($user_id);

        return response()->json(['totalScore' => $totalScore]);
    }

    public function scoreFromIds(Request $request)
    {

        $datas = $request->all();
        $user_id = $datas['user_id'];
        $qcm_id = $datas['qcm_id'];

        $score = Score::where('user_id', $user_id)->where('qcm_id', $qcm_id)->first();

        if(!count($score)) {
            return response()->json(['todo' => 'todo']);
        }else if($score->status == 'done'){
            return response()->json(['already' => 'already', 'score' => $score]);
        }
    }
}
