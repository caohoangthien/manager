<?php

namespace App\Http\Frontend\Controllers;

use Illuminate\Http\Request;
use App\Services\Frontend\SalaryService;

class SalaryController extends Controller
{

    /**
     * SalaryService
     *
     * @var $salaryService
     */
    protected $salaryService;

    /**
     * SalaryController constructor.
     *
     * @param SalaryService $salaryService SalaryService
     *
     * @return mixed
     */
    public function __construct(SalaryService $salaryService)
    {
        $this->salaryService = $salaryService;
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request Request
     *
     * @return view
     */
    public function show(Request $request)
    {
        $time = $request->only(['time']);
        $data = $this->salaryService->getData($time);
        $employees = $data['employees'];
        $days = $data['days'];
        $months = $data['months'];
        $month = $data['month'];

        return view('frontend.salary.show', compact('employees', 'days', 'months', 'month'));
    }
}
