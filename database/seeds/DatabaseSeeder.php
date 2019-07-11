<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(ManagerTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(LogWorkTableSeeder::class);
        $this->call(SalaryTableSeeder::class);
    }
}
