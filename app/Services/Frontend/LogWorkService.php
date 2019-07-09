<?php

namespace App\Services\Frontend;

use App\Models\Employee;
use App\Models\LogWork;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LogWorkService
{
    /**
     * Get log work
     *
     * @return array
     */
    public function getLogWork()
    {
        $currentMonth = Carbon::today()->month;
        $with['logWork'] = function ($query) use ($currentMonth) {
            return $query->whereMonth('date', $currentMonth)->select('employee_id', 'date', 'status')->orderBy('date', 'asc');
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
     * Get day of current month
     *
     * @return array
     */
    public function getDayOfCurrentMonth()
    {
        $start = Carbon::today()->startOfMonth()->day;
        $end = Carbon::today()->endOfMonth()->day;
        for ($i = $start; $i <= $end; $i++) {
            $data[] = $i;
        }

        return $data;
    }
}
