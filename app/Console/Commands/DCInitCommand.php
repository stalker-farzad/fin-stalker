<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DCInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dc:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize the project requirements';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!file_exists(".env")){
            $this->comment("Copy .env file from .env.example");
            exec("cp .env.example .env");
            $this->info("The .env file has been created.");
        }

        $this->comment('Generating Laravel App Key...');
        Artisan::call('key:generate');
        $this->info("The app key has been generated.");

        $this->comment('Running Database Migrations...');
        Artisan::call('dc:migrate');
        $this->info("The application database has been migrated.");

        $this->info('Installation has been completed.');
    }
}
