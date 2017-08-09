<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Qcm;

class qcmController extends Controller
{
    public function __construct(Qcm $qcm) {
        $this->qcm = $qcm;
    }

    public function create(Request $request) {

        return response()->json(['test' => $request->get("title"), "test2" => $request->get("questions")]);

    }
}
