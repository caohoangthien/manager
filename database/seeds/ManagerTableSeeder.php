<?php

use Illuminate\Database\Seeder;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class ManagerTableSeeder extends Seeder
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

        for ($i = 1; $i <= 40; $i ++) {
            DB::table('managers')->insert([
                'name' => $faker->name,
                'email' => 'manager' . $i . '@gmail.com',
                'password' => app('hash')->make('1234567'),
                'company_id' => $companyIds[$i],
                'status' => 1,
                'level' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }
    }
}
