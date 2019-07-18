<?php

use App\Models\Company;
use App\Models\Employee;
use App\Models\Manager;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::today()->addMonthNoOverflow()->startOfMonth();
        $month = $time->copy()->subMonth()->endOfMonth();
        $companyId = Company::first(['id'])->id;
        $employeeIds = Employee::where('company_id', $companyId)
            ->get(['id'])
            ->pluck('id')
            ->toArray();

        for ($j = 0; $j <= 19; $j++) {
            DB::table('salaries')->insert([
                'company_id' => $companyId,
                'employee_id' => $employeeIds[$j],
                'bonus' => 500000,
                'month' => $month,
                'day_work' => 25,
                'day_off' => 6,
                'day_off_available' => 3,
                'day_off_available_used' => 5,
                'day_salary' => 22,
                'salary_real' => 8500000,
                'created_at' => $time,
                'updated_at' => $time
            ]);
        }
    }
}
