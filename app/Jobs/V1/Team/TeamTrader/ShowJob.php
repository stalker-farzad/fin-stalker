<?php

namespace App\Jobs\V1\Team\TeamTrader;

use App\Repositories\V1\Team\Trader\ITeamTraderRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class ShowJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private ITeamTraderRepository $repository;
    private string $uuid;
    /**
     * Create a new job instance.
     */
    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
        $this->repository = app()->make(ITeamTraderRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            return $this->repository->show($this->uuid);
        } catch ( Exception $exception ) {
            throw new Exception($exception->getMessage());
        }

    }
}
