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
}
