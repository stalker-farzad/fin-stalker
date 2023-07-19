<?php

namespace App\Jobs\V1\Team;

use App\Events\V1\Team\StoreEvent;
use App\Jobs\SyncJob;
use App\Repositories\V1\Team\ITeamRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;

class StoreJob extends SyncJob
{
    private ITeamRepository $teamRepository;

    /**
     * Create a new job instance.
     * @throws BindingResolutionException
     */
    public function __construct(
        public array $data
    )
    {
        $this->teamRepository = app()->make(ITeamRepository::class);
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(): Model
    {
        try {
            $result = $this->teamRepository->create($this->data);

            if ($result)
            {
                event(new StoreEvent($result));
            }

            return $result;

        }catch (Exception $exception){

            throw new Exception($exception->getMessage());

        }
    }
}
