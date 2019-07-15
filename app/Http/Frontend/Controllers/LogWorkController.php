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
     * Show log work
     *
     * @param Request $request Request
     *
     * @return view
     */
    public function show(Request $request)
    {
        $time = $request->only(['time']);
        $data = $this->logWorkService->getData($time);
        $logWork = $data['logWork'];
        $days = $data['days'];
        $months = $data['months'];
        $month = $data['month'];

        return view('frontend.logwork.show', compact('logWork', 'days', 'months', 'month'));
    }
}
