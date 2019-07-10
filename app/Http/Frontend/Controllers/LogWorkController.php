<?php

namespace App\Http\Frontend\Controllers;

use Carbon\Carbon;
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
     * Display the specified resource.
     *
     * @param  int  $month
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = $request->only(['time']);
        $time = $this->logWorkService->validateYearMonth($data['time']);
        $logWork = $this->logWorkService->getLogWork($time);
        $days = $this->logWorkService->getDayOfCurrentMonth($time);
        $months = $this->logWorkService->getMonths();
        $month = $time['month'] . ' - ' . $time['year'];

        return view('frontend.logwork.index', compact('logWork', 'days', 'months', 'month'));
    }
}
