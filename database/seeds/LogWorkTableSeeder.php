<?php

use App\Models\Company;
use App\Models\Employee;
use \App\Models\Manager;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LogWorkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::today();
        $companyId = Company::first(['id'])->id;
        $employeeIds = Employee::where('company_id', $companyId)
            ->get(['id'])
            ->pluck('id')
            ->toArray();
        $managerId = Manager::first(['id'])->id;

        for ($i = 1; $i <= 50; $i ++) {
            for ($j = 0; $j <= 19; $j++) {
                DB::table('log_work')->insert([
                    'company_id' => $companyId,
                    'employee_id' => $employeeIds[$j],
                    'status' => rand(1,2),
                    'date' => $now,
                    'manager_id' => $managerId,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }
            $now->subDay();
        }
    }
}
