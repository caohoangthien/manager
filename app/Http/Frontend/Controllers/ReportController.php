<?php

namespace App\Http\Frontend\Controllers;

use Illuminate\Http\Request;
use App\Services\Frontend\ReportService;

class ReportController extends Controller
{

    /**
     * ReportService
     *
     * @var $reportService
     */
    protected $reportService;

    /**
     * ReportController constructor.
     *
     * @param ReportService $reportService ReportService
     *
     * @return mixed
     */
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request Request
     *
     * @return view
     */
    public function showDay(Request $request)
    {
        $time = $request->only(['time']);
        $data = $this->reportService->getDataReportDay($time);
        $transactions = $data['transactions'];
        $days = $data['days'];
        $months = $data['months'];
        $month = $data['month'];

        return view('frontend.report.day', compact('transactions', 'days', 'months', 'month'));
    }
}
