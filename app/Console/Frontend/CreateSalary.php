<?php

namespace App\Console\Frontend;

use App\Models\Company;
use App\Services\Frontend\EmployeeService;
use App\Services\Frontend\LogWorkService;
use App\Services\Frontend\SalaryService;
use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;
use Log;

class CreateSalary extends Command
{

    /**
     * LogWorkService
     *
     * @var $logWorkService
     */
    protected $logWorkService;

    /**
     * SalaryService
     *
     * @var $salaryService
     */
    protected $salaryService;

    /**
     * EmployeeService
     *
     * @var $employeeService
     */
    protected $employeeService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-salary';

    /**
     * Create a new command instance.
     *
     * @param SalaryService   $salaryService   SalaryService
     * @param LogWorkService  $logWorkService  LogWorkService
     * @param EmployeeService $employeeService EmployeeService
     *
     * @return void
     */
    public function __construct(
        SalaryService $salaryService,
        LogWorkService $logWorkService,
        EmployeeService $employeeService
    ) {
        parent::__construct();
        $this->salaryService = $salaryService;
        $this->logWorkService = $logWorkService;
        $this->employeeService = $employeeService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('=====================================================================');
        $this->info("=            Create salary: " . Carbon::now() . "                 =");
        $this->info('=====================================================================');

        $companyIds = Company::pluck('id')->toArray();

        foreach ($companyIds as $companyId) {
            $logwork = $this->logWorkService->getLogWorkEmployees($companyId);

            foreach ($logwork as $emp) {
                $dataUpdate = $this->salaryService->updateDayOff($emp);

                $data[] = [
                    'company_id' => $dataUpdate->company_id,
                    'employee_id' => $dataUpdate->employee_id,
                    'month' => Carbon::today()->format('Y-m-d'),
                    'day_work' => $dataUpdate->count_working,
                    'day_off' => $dataUpdate->count_off,
                    'day_off_available_used' => $dataUpdate->day_off_available_used,
                    'day_off_available' => $dataUpdate->day_off_available,
                    'day_salary' => $dataUpdate->day_salary,
                    'salary_real' => $dataUpdate->salary_real,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }

            DB::table('salaries')->insert($data);
        }
        Log::info('Tạo dữ liệu lương thành công');
    }
}
