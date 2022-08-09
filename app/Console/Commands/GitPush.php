<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GitPush extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'git:push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Git deploy base..........';

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
        

        exec('git add .');
        $this->info('Git added successfully');

        exec('git commit -m "Auto push from command"');
        $this->info('Git commited successfully');

        exec('git push');
        $this->info('Git push successfully');

        //activity('Git Push')->log('Git Push to git server');
    }
}
