<?php

namespace App\Jobs\V1\Team\TeamTrader;

use App\Repositories\V1\Team\Trader\ITeamTraderRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class StoreJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private ITeamTraderRepository $repository;
    /**
     * Create a new job instance.
     */
    public function __construct(public array $data)
    {
        $this->repository = app()->make(ITeamTraderRepository::class);
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
