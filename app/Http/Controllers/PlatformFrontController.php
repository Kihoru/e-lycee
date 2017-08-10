<?php

namespace App\Http\Controllers;

use App\Qcm;
use App\Comment;
use App\User;
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
}
