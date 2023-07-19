<?php

namespace App\Jobs\V1\my\TeamTrader;

use App\Repositories\V1\my\TeamTrader\IMyTeamTraderRepository;
use App\Repositories\V1\my\TeamTrader\MyTeamTraderRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class UpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private IMyTeamTraderRepository $repository;
    private string $uuid;
    private string $user_id;
    /**
     * Create a new job instance.
     */
    public function __construct(public array $data, string $uuid ,string $user_id)
    {
        $this->uuid = $uuid;
        $this->user_id = $user_id;
        $this->repository = app()->make(MyTeamTraderRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            $result = $this->repository->show($this->uuid, $this->user_id);
            if (isset($result))
            {
                return $this->repository->update($this->uuid , $this->data);
            }
        } catch ( Exception $exception ) {
            throw new Exception($exception->getMessage());
        }

    }
}
