<?php

namespace App\Services\Frontend;

use App\Models\Employee;
use App\Models\LogWork;
use Carbon\Carbon;
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

    /**
     * Get log work of employee
     *
     * @param int $companyId Company id
     *
     * @return array
     */
    public function getLogWorkEmployees(int $companyId)
    {
        $lastMonth = Carbon::today()->subMonthNoOverflow()->month;
        $year = Carbon::today()->subMonthNoOverflow()->year;

        $empWorking = DB::table('log_work')
            ->select(DB::raw('count(id) as count_working'), 'employee_id')
            ->where('status', LogWork::WORKING)
            ->where('company_id', $companyId)
            ->whereMonth('date', $lastMonth)
            ->whereYear('date', $year)
            ->groupBy('employee_id');

        $employeeOff = DB::table('log_work')
            ->select(DB::raw('count(id) as count_off'), 'employee_id')
            ->where('status', LogWork::OFF)
            ->where('company_id', $companyId)
            ->whereMonth('date', $lastMonth)
            ->whereYear('date', $year)
            ->groupBy('employee_id');

        $employeeSalaryLastMonth = DB::table('salaries')
            ->select('day_off_available_used', 'day_off_available', 'employee_id')
            ->where('company_id', $companyId)
            ->whereMonth('month', $lastMonth)
            ->whereYear('month', $year);

        $bindings = [
            LogWork::WORKING,
            $companyId,
            $lastMonth,
            $year,
            LogWork::OFF,
            $companyId,
            $lastMonth,
            $year,
            $companyId,
            $lastMonth,
            $year,
        ];

        return DB::table('employees')
            ->rightJoin(DB::raw("({$empWorking->toSql()}) as tmp"), 'employees.id', '=', 'tmp.employee_id')
            ->rightJoin(DB::raw("({$employeeOff->toSql()}) as tmp2"), 'employees.id', '=', 'tmp2.employee_id')
            ->rightJoin(DB::raw("({$employeeSalaryLastMonth->toSql()}) as tmp3"), 'employees.id', '=', 'tmp3.employee_id')
            ->addBinding($bindings)
            ->select(
                'tmp.employee_id',
                'tmp.count_working',
                'tmp2.count_off',
                'employees.company_id',
                'employees.salary',
                'tmp3.day_off_available',
                'tmp3.day_off_available_used'
            )
            ->get();
    }
}
