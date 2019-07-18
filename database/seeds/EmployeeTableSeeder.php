<?php

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $now = date("Y-m-d H:i:s");
        $companyIds = Company::all(['id'])->pluck('id')->toArray();

        for ($i = 0; $i <= 49; $i ++) {
            for ($j = 0; $j <= 19; $j ++) {
                DB::table('employees')->insert([
                    'name' => $faker->name,
                    'birthday' => $faker->date('Y-m-d H:i:s'),
                    'phone' => $faker->phoneNumber,
                    'bank_account' => rand(1000000, 9999999),
                    'address' => $faker->address,
                    'gender' => rand(1,2),
                    'salary' => 10000000,
                    'company_id' => $companyIds[$i],
                    'start_time' => $now,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }
        }
    }
}
