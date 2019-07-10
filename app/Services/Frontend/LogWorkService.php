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
     * Get log work
     *
     * @return array
     */
    public function getLogWork($time)
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
     * Get log work
     *
     * @return array
     */
    public function validateYearMonth($time)
    {
        $data = explode('-', $time);

        if (count($data) == 2 && $data[0] >= 1 && $data[0] <= 12 && $data[1] >= 2019 && $data[1] <= 2090) {
            return [
                'year' => (int)$data[1],
                'month' => (int)$data[0]
            ];
        }

        return [
            'year' => Carbon::today()->year,
            'month' => Carbon::today()->month
        ];
    }

    /**
     * Get day of current month
     *
     * @return array
     */
    public function getDayOfCurrentMonth($time)
    {
        $a = Carbon::create($time['year'], $time['month'], 1);

        $start = $a->startOfMonth()->day;
        $end = $a->endOfMonth()->day;
        for ($i = $start; $i <= $end; $i++) {
            $data[] = $i;
        }

        return $data;
    }

    /**
     * Get day of current month
     *
     * @return array
     */
    public function getMonths()
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
