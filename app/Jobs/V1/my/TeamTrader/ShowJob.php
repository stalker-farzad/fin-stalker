<?php

namespace App\Jobs\V1\my\TeamTrader;

use App\Jobs\SyncJob;
use App\Repositories\V1\my\TeamTrader\IMyTeamTraderRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class ShowJob extends SyncJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private IMyTeamTraderRepository $repository;
    private string $uuid;
    private string $user_id;
    /**
     * Create a new job instance.
     */
    public function __construct(string $user_id , string $uuid)
    {
        $this->user_id = $user_id;
        $this->uuid = $uuid;
        $this->repository = app()->make(IMyTeamTraderRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            return $this->repository->show($this->uuid, $this->user_id);
        } catch ( Exception $exception ) {
            throw new Exception($exception->getMessage());
        }
    }

}
