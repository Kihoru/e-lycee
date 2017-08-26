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

    public function __construct(Qcm $qcm, User $user, Post $post, Comment $comment)
    {
        $this->qcm = $qcm;
        $this->post = $post;
        $this->user = $user;
        $this->comment = $comment;
    }

    public function home()
    {

        $userNb = User::all()->where('role', '!=', 'teacher')->count();
        $commentNb = Comment::count();
        $qcmNb = Qcm::count();

        $lastQcm = $this->qcm->getLasts(3);
        $lastPosts = $this->post->getLasts(3);
        $bestStudents = [0, 1, 2];//DB::select( DB::raw("") );

        return response()->json(
            [
                'nbUser' => $userNb,
                'nbComment' => $commentNb,
                'nbQcm' => $qcmNb,
                'lastQcm' => $lastQcm,
                'lastPosts' => $lastPosts,
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
