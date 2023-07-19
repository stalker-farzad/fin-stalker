<?php

namespace App\Jobs\V1\Team;

use App\Events\V1\Team\DeleteEvent;
use App\Jobs\SyncJob;
use App\Repositories\V1\Team\ITeamRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class DeleteJob extends SyncJob
{
    private ITeamRepository $teamRepository;

    /**
     * Create a new job instance.
     * @throws BindingResolutionException
     */
    public function __construct(
        public string $uuid
    )
    {
        $this->teamRepository = app()->make(ITeamRepository::class);
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(): array
    {
        try {

            $team = $this->teamRepository->singleByUuid($this->uuid);

            if (isset($team)) {

                $result = $this->teamRepository->deleteByIdAndUserId($this->uuid);

                if ($result) {
                    event(new DeleteEvent($team));
                }

                return $team;

            } else {
                return [];
            }

        }catch (Exception $exception){

            throw new Exception($exception->getMessage());

        }
    }
}
