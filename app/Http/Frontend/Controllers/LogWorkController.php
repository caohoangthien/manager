<?php

namespace App\Http\Frontend\Controllers;

use Illuminate\Http\Request;
use App\Services\Frontend\LogWorkService;

class LogWorkController extends Controller
{

    /**
     * LogWorkService
     *
     * @var $logWorkService
     */
    protected $logWorkService;

    /**
     * LogWorkController constructor.
     *
     * @param LogWorkService $logWorkService LogWorkService
     *
     * @return mixed
     */
    public function __construct(LogWorkService $logWorkService)
    {
        $this->logWorkService = $logWorkService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logWork = $this->logWorkService->getLogWork();
        $days = $this->logWorkService->getDayOfCurrentMonth();

        return view('frontend.logwork.index', compact('logWork', 'days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
