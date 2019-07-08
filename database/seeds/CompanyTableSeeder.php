<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder
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

        for ($i = 1; $i <= 50; $i ++) {
            DB::table('companies')->insert([
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'bank_account' => rand(1000000, 9999999),
                'email' => $faker->email,
                'note' => '',
                'type_log_work' => 1,
                'start_time' => $now,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }
    }
}
