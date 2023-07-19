<?php

namespace App\Jobs\V1\my\TeamTrader;

use App\Jobs\SyncJob;
use App\Repositories\V1\my\TeamTrader\IMyTeamTraderRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class StoreJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private IMyTeamTraderRepository $repository;


    /**
     * Create a new job instance.
     */
    public function __construct(public array $data)
    {
        $this->repository = app()->make(IMyTeamTraderRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            return $this->repository->store($this->data);
        } catch ( Exception $exception ) {
            throw new Exception($exception->getMessage());
        }
    }
}
