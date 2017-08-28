<?php

namespace App\Http\Controllers;

use App\Qcm;
use App\Comment;
use App\User;
use App\Score;
use App\Post;
use Illuminate\Http\Request;
use DB;

class PlatformFrontController extends Controller
{

    public function __construct(Qcm $qcm, User $user, Post $post, Comment $comment)
    {
        $this->qcm = $qcm;
        $this->post = $post;
        $this->user = $user;
        $this->comment = $comment;
    }

    private function getBestStudents($users)
    {
        $bests = array();
        $response = array();

        foreach($users as $user)
        {
            if(!is_null($user->note)) {
                $user->total = ($user->note / $user->nb);

                if(empty($bests)) {
                    $bests[0] = $user;
                }else if($bests[0]->total < $user->total) {
                    $oldRecord = $bests[0];
                    $bests[0] = $user;
                    if($bests[1]->total < $oldRecord->total) {
                        $bests[1] = $oldRecord;
                    }
                }else if(empty($bests[1])) {
                    $bests[1] = $user;
                }else if($bests[1]->total < $user->total) {
                    $oldRecord = $bests[1];
                    $bests[1] = $user;
                    if($bests[2]->total < $oldRecord->total) {
                        $bests[2] = $oldRecord;
                    }
                }else if(empty($bests[2])) {
                    $bests[2] = $user;
                }else if($bests[2]->total < $user->total) {
                    $bests[2] = $user;
                }
            }
        }

        return $bests;
    }

    public function home()
    {

        $userNb = User::all()->where('role', '!=', 'teacher')->count();
        $commentNb = Comment::count();
        $qcmNb = Qcm::count();

        $lastQcm = $this->qcm->getLasts(3);
        $lastPosts = $this->post->getLasts(3);
        $bestStudents = DB::select(DB::raw("SELECT u.username, u.id, sum(s.note) as note, count(s.note) as nb FROM users as u LEFT JOIN scores as s ON s.user_id = u.id WHERE u.role != 'teacher' GROUP BY u.id"));
        $bestStudents = $this->getBestStudents($bestStudents);

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

    public function students()
    {
        $students = DB::select(DB::raw("SELECT u.id, u.username, u.role, count(s.id) as nb, sum(s.note) as score FROM users as u LEFT JOIN scores as s ON s.user_id = u.id WHERE u.role != 'teacher' GROUP BY u.id"));

        if(count($students)) {
            $response = ["students" => $students];
        }else{
            $response = ["Error" => "No datas available."];
        }

        return response()->json($response);
    }
}
