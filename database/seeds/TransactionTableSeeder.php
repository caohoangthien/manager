<?php

use App\Models\Company;
use App\Models\Employee;
use App\Models\Manager;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::today();
        $companyId = Company::first(['id'])->id;

        for ($j = 0; $j <= 49; $j++) {
            DB::table('transactions')->insert([
                'company_id' => $companyId,
                'money' => rand(100000, 1000000),
                'reason' => "Đi nhậu",
                'status' => rand(1,2),
                'date' => $time,
                'causer' => "Cao Hoàng Thiện",
                'created_at' => $time,
                'updated_at' => $time
            ]);
            $time->subDay();
        }
    }
}
