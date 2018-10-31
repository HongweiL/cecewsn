<?php

namespace App\Console\Commands;

use App\API\Process;
use Illuminate\Console\Command;

class processCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'processCmd:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Data processor';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $process = new Process();
        $process -> StartProcess();
    }
}
