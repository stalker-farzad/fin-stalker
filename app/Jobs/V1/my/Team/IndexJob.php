<?php

namespace App\Jobs\V1\my\Team;

use App\Jobs\SyncJob;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use App\Repositories\V1\my\Team\ITeamRepository as MyITeamRepository;

class IndexJob extends SyncJob
{
    private MyITeamRepository $teamRepository;

    /**
     * Create a new job instance.
     * @throws BindingResolutionException
     */
    public function __construct(
        public array $data,
        public string $userUuid,
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

           return $this->teamRepository->indexByUserUuid($this->userUuid, $this->data);

        }catch (Exception $exception){

            throw new Exception($exception->getMessage());

        }
    }
}
