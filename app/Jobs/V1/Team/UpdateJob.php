<?php

namespace App\Jobs\V1\Team;

use App\Events\V1\Team\UpdateEvent;
use App\Jobs\SyncJob;
use App\Repositories\V1\Team\ITeamRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class UpdateJob extends SyncJob
{
    private ITeamRepository $teamRepository;

    /**
     * Create a new job instance.
     * @throws BindingResolutionException
     */
    public function __construct(
        public array $data,
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
            $result = $this->teamRepository->updateByUuid($this->data, $this->uuid);

            $team = [];

            if ($result) {
                $team = $this->teamRepository->singleByUuid($this->uuid);
                event(new UpdateEvent($team));
            }

            return $team;

        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }
}
