<?php

namespace App\Services\Frontend;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use DB;

class LogWorkService
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
     * Get data
     *
     * @param array $time Time
     *
     * @return array
     */
    public function getData(array $time)
    {
        $time = $this->commonService->validateYearMonth($time['time']);

        return [
            'logWork' => $this->getLogWork($time),
            'days' => $this->commonService->getDayOfMonth($time),
            'months' => $this->getMonths(),
            'month' => $time['month'] . ' - ' . $time['year']
        ];
    }

    /**
     * Get log work
     *
     * @param array $time Time
     *
     * @return array
     */
    private function getLogWork($time)
    {
        $with['logWork'] = function ($query) use ($time) {
            return $query->whereMonth('date', $time['month'])
                ->whereYear('date', $time['year'])
                ->select('employee_id', DB::raw('EXTRACT(day FROM "date") as date'), 'status')
                ->orderBy('date', 'asc');
        };

        $employees = Employee::with($with)
            ->where('company_id', Auth::user()->company_id)
            ->select(['id', 'name'])
            ->get();

        foreach($employees as $employee) {
            $data[$employee->name] = $employee->logWork->pluck('status', 'date')->toArray();
        }

        return $data;
    }

    /**
     * Get months of log work
     *
     * @return array
     */
    private function getMonths()
    {
        $columns = [
            DB::raw('EXTRACT(year FROM "date") as year'),
            DB::raw('EXTRACT(month FROM "date") as month')
        ];

        $sub = DB::table('log_work')
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
