<?php

namespace App\Console\Frontend;

use Illuminate\Console\Command;
use Log;

class Test extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('Test');
    }
}
