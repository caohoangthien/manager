<?php

namespace App\Console\Frontend;

use App\Models\Employee;
use App\Models\LogWork;
use App\Services\Frontend\LogWorkService;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Log;
use DB;

class CreateLogWork extends Command
{

    /**
     * LogWorkService
     *
     * @var $logWorkService
     */
    protected $logWorkService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-log-work';

    /**
     * Create a new command instance.
     *
     * @param LogWorkService $logWorkService LogWorkService
     *
     * @return void
     */
    public function __construct(
        LogWorkService $logWorkService
    ) {
        parent::__construct();
        $this->logWorkService = $logWorkService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('=====================================================================');
        $this->info("=            Create log work: " . Carbon::now() . "                 =");
        $this->info('=====================================================================');

        $employees = Employee::all(['id', 'company_id']);

        foreach ($employees as $employee) {
            $data[] = [
                'company_id' => $employee->company_id,
                'employee_id' => $employee->id,
                'status' => LogWork::WORKING,
                'date' => Carbon::today()->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        DB::table('log_work')->insert($data);
        Log::info('Tạo dữ liệu chấm công thành công ' . Carbon::now());
    }
}
