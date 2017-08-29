<?php

namespace App\Http\Controllers;

use App\Repositeries\PlatformRepository;
use Illuminate\Http\Request;

class PlatformFrontController extends Controller
{

    /**
     * Construct the PostController object
     *
     * @param  App\Repositeries\PlatformRepository  $platformRepository
     */
    public function __construct(PlatformRepository $platformRepository)
    {
        $this->platformRepository = $platformRepository;
    }

    /**
     * Get the home datas for teachers
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return $this->platformRepository->home();
    }

    /**
     * Get the home datas for students
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function homeStudent(Request $request)
    {
        return $this->platformRepository->homeStudent($request);
    }


    /**
     * Get the student list
     *
     * @return \Illuminate\Http\Response
     */
    public function students()
    {
        return $this->platformRepository->students();
    }
}
