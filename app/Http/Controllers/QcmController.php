<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositeries\QcmRepository;

class QcmController extends Controller
{
    /**
     * Construct the QcmController object
     *
     * @param  App\Repositeries\QcmRepository  $qcmRepository
     */
    public function __construct(QcmRepository $qcmRepository)
    {
        $this->qcmRepository = $qcmRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->qcmRepository->getAll();
    }

    /**
     * Display a listing of the resource with special user data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAllFromStudent(Request $request)
    {
        return $this->qcmRepository->getAllFromStudent($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->qcmRepository->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->qcmRepository->one($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->qcmRepository->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->qcmRepository->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->qcmRepository->delete($id);
    }

    /**
     * Add a score after validating qcm
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addScore(Request $request)
    {
        return $this->qcmRepository->addScore($request);
    }
}
