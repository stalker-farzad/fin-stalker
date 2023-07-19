<?php

namespace App\Jobs\V1\my\TeamTrader;

use App\Jobs\SyncJob;
use App\Repositories\V1\my\TeamTrader\IMyTeamTraderRepository;
use App\Repositories\V1\my\TeamTrader\MyTeamTraderRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class IndexJob extends SyncJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private IMyTeamTraderRepository $repository;
    private string $user_id;
    /**
     * Create a new job instance.
     */
    public function __construct(string $user_id , public array $data)
    {
        $this->user_id = $user_id;
        $this->repository = app()->make(IMyTeamTraderRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        try {
            return $this->repository->index($this->user_id , $this->data);
        } catch ( Exception $exception ) {
            throw new Exception($exception->getMessage());
        }

    }
}
