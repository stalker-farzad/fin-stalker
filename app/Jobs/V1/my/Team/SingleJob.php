<?php

namespace App\Jobs\V1\my\Team;

use App\Jobs\SyncJob;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use App\Repositories\V1\my\Team\ITeamRepository as MyITeamRepository;

class SingleJob extends SyncJob
{
    private MyITeamRepository $teamRepository;

    /**
     * Create a new job instance.
     * @throws BindingResolutionException
     */
    public function __construct(
        public $uuid,
        public $userUuid,
    )
    {
        $this->teamRepository = app()->make(MyITeamRepository::class);
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle()
    {
        try {

            return $this->teamRepository->singleByUserUuid($this->userUuid, $this->uuid);

        }catch (Exception $exception){
            throw new Exception($exception->getMessage());

        }
    }
}
