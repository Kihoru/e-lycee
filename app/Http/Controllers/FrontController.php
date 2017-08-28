<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view("school.parts.index");
    }

    public function contact()
    {
        return view("school.parts.contact");
    }

    public function lycee()
    {
        return view("school.parts.lycee");
    }

    public function mlegales()
    {
        return view("school.parts.mlegales");
    }

    public function actus()
    {
        return view("school.parts.actus");
    }

    public function actuOne($id)
    {
        return view("school.parts.actuOne");
    }
}
