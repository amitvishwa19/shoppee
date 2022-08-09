<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class AppCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will serve as enty point if cron job on the server';

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
     * @return int
     */
    public function handle()
    {
        $act = activity()->log('This command is run by task schedular at' . Carbon::now());


        $this->info('app:cron command run successfully');

    }
}
