<?php

namespace App\Http\Controllers;

use App\Qcm;
use App\Comment;
use App\User;
use App\Score;
use App\Post;
use Illuminate\Http\Request;

class PlatformFrontController extends Controller
{
    public function home()
    {

        $userNb = User::all()->where('role', '!=', 'teacher')->count();
        $commentNb = Comment::count();
        $qcmNb = Qcm::count();

        $lastQcm = Qcm::getLasts(3);
        $lastComments = Post::getLasts(3);
        $bestStudents = DB::select( DB::raw("") );

        return response()->json(
            [
                'nbUser' => $userNb,
                'nbComment' => $commentNb,
                'nbQcm' => $qcmNb,
                'lastQcm' => $lastComments,
                'bestStudents' => $bestStudents
            ]
        );

    }

    public function homeStudent(Request $request)
    {
        $user_id = $request->only('user_id');

        $totalScore = Score::getTotalScore($user_id);

        return response()->json(['totalScore' => $totalScore]);
    }
}
