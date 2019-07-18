<?php

namespace App\Services\Frontend;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use mysql_xdevapi\Collection;

class SalaryService
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
            'employees' => $this->getSalaries($time),
            'days' => $this->commonService->getDayOfMonth($time),
            'months' => $this->getMonths(),
            'month' => $time['month'] . ' - ' . $time['year']
        ];
    }

    /**
     * Get employees
     *
     * @param array $time Time
     *
     * @return array
     */
    private function getSalaries(array $time)
    {
        $with['salaries'] = function ($query) use ($time) {
            return $query->whereMonth('month', $time['month'])
                ->whereYear('month', $time['year'])
                ->select('employee_id', 'day_off', 'day_work', 'day_off_available', 'day_off_available_used', 'month', 'bonus','day_salary', 'salary_real')
                ->get();
        };

        $with['logWork'] = function ($query) use ($time) {
            return $query->whereMonth('date', $time['month'])
                ->whereYear('date', $time['year'])
                ->select('employee_id', 'date', 'status')
                ->orderBy('date', 'asc');
        };

        return Employee::with($with)
            ->where('company_id', Auth::user()->company_id)
            ->select(['id', 'name', 'salary'])
            ->paginate(15);
    }

    /**
     * Get month of salary
     *
     * @return array
     */
    private function getMonths()
    {
        $columns = [
            DB::raw('EXTRACT(year FROM "month") as year'),
            DB::raw('EXTRACT(month FROM "month") as month')
        ];

        $sub = DB::table('salaries')
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
     * Update day off
     *
     * @param Collection $data Data
     *
     * @return array
     */
    public function updateDayOff($data)
    {
        $data->day_off_available = $data->day_off_available + 1;
        $dateOfMonth = Carbon::today()->subMonthNoOverflow()->endOfMonth()->day;

        if ($data->count_off <= $data->day_off_available) {
            $data->day_off_available_used = $data->day_off_available_used + $data->count_off;
            $data->day_off_available = $data->day_off_available - $data->count_off;
            $data->day_salary = $data->count_working;
        } else {
            $data->day_off_available_used = $data->day_off_available_used + $data->day_off_available;
            $data->day_off_available = 0;
            $data->day_salary = $data->count_working - ($data->count_off - $data->day_off_available);
        }

        $data->salary_real = (int)($data->salary / $dateOfMonth * $data->day_salary);

        return $data;
    }


}
