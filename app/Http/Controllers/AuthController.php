<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    public function __construct(User $user, JWTAuth $jwtauth)
    {
        $this->jwtauth = $jwtauth;
        $this->user = $user;
        // Apply the jwt.auth middleware to all methods in this controller
        // except for the authenticate method. We don't want to prevent
        // the user from retrieving their token if they don't already have it
        $this->middleware('jwt.auth', ['except' => ['login', 'logout']]);
    }

    public function login(Request $request) {

        $username = htmlspecialchars($request->get('username'));
        $password = htmlspecialchars($request->get('password'));

        $thisUser = $this->user->select()->where('username', $username)->first();

        if(!$thisUser){
            return response()->json(['error' => 'utilisateur non trouvé']);
        }else if(!password_verify($password ,$thisUser->password)){
            return response()->json(['error' => 'mot de passe invalide']);
        }else{
            $logInUser = array(
                'id' => $thisUser->id,
                'username' => $thisUser->username,
                'role' => $thisUser->role
            );
            $token = $this->jwtauth->fromUser($thisUser);
            return response()->json(compact('token', 'logInUser'));
        }
    }
}
