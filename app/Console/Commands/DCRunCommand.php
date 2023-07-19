<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DCRunCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dc:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Running the project to start';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment("Clear the routes cache");
        $this->call("route:clear");
        $this->info("The routes cache has been cleared.");

        $this->info('Running has been completed.');
    }
}
