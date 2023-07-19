<?php

namespace App\Jobs\V1\Team;

use App\Jobs\SyncJob;
use App\Repositories\V1\Team\ITeamRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class SingleJob extends SyncJob
{
    private ITeamRepository $teamRepository;

    /**
     * Create a new job instance.
     * @throws BindingResolutionException
     */
    public function __construct(
        public $uuid
    )
    {
        $this->teamRepository = app()->make(ITeamRepository::class);
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle()
    {
        try {

            return $this->teamRepository->singleByUuid($this->uuid);

        }catch (Exception $exception){

            throw new Exception($exception->getMessage());

        }
    }
}
