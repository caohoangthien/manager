<?php

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now =  Carbon::today()->startOfMonth();
        $to = Carbon::today()->day;
        $companyId = Company::first(['id'])->id;

        for ($j = 1; $j <= $to; $j++) {
            $in = rand(100000, 1000000);
            $out = rand(100000, 1000000);
            $interest = $in - $out;
            DB::table('reports')->insert([
                'company_id' => $companyId,
                'money_in' => $in,
                'money_out' => $out,
                'date' => $now,
                'interest' => $interest,
                'created_at' => $now,
                'updated_at' => $now
            ]);
            $now->addDay();
        }
    }
}
