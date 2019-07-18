<?php

namespace App\Services\Frontend;

use App\Models\Employee;
use App\Models\LogWork;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use DB;

class ReportService
{

    /**
     * CommonService
     *
     * @var $commonService
     */
    protected $commonService;

    /**
     * LogWorkService constructor.
     *
     * @param CommonService $commonService CommonService
     *
     * @return mixed
     */
    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    /**
     * Get data report day
     *
     * @param array $data Data
     *
     * @return array
     */
    public function getDataReportDay(array $data)
    {
        $time = $this->commonService->validateYearMonth($data['time']);

        return [
            'transactions' => $this->getTransaction($time),
            'days' => $this->commonService->getDayOfMonth($time),
            'months' => $this->getMonths(),
            'month' => $time['month'] . ' - ' . $time['year']
        ];
    }

    /**
     * Get transaction
     *
     * @param array $time Time
     *
     * @return array
     */
    public function getTransaction(array $time)
    {
        $data = Transaction::whereMonth('date', $time['month'])
            ->whereYear('date', $time['year'])
            ->where('company_id', Auth::user()->company_id)
            ->select(DB::raw('sum(case when status = 1 then money else 0 end) as money_in'), DB::raw('sum(case when status = 2 then money else 0 end) as money_out'), 'date')
            ->groupBy('date')
            ->get();

        foreach ($data as $value) {
            $report[] = [
                'date' => $value->date,
                'money_in' => $value->money_in,
                'money_out' => $value->money_out,
                'interest' => $value->money_in - $value->money_out
            ];
        }

        return $report;
    }

    /**
     * Get month of salary
     *
     * @return array
     */
    private function getMonths()
    {
        $columns = [
            DB::raw('EXTRACT(year FROM "date") as year'),
            DB::raw('EXTRACT(month FROM "date") as month')
        ];

        $sub = DB::table('transactions')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->groupBy('year', 'month')
            ->select($columns)
            ->take(6);

        return DB::table(DB::raw("({$sub->toSql()}) as sub"))->select([
            DB::raw('sub.month || \'' . '-'
                . '\' || sub.year || \'' . '\'  as text'),
            'sub.year',
            'sub.month'
        ])->get();
    }
}
