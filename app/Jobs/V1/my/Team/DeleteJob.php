<?php

namespace App\Jobs\V1\my\Team;

use App\Events\V1\Team\DeleteEvent;
use App\Jobs\SyncJob;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use App\Repositories\V1\my\Team\ITeamRepository as MyITeamRepository;
use Illuminate\Database\Eloquent\Model;

class DeleteJob extends SyncJob
{
    private MyITeamRepository $repository;

    /**
     * Create a new job instance.
     * @throws BindingResolutionException
     */
    public function __construct(
        public string $uuid,
        public string $userUuid,
    )
    {
        $this->repository = app()->make(MyITeamRepository::class);
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(): string
    {
        try {
            $team = $this->repository->SingleByUuid($this->uuid);
            if ($team->user_id === $this->userUuid){
                $result = $this->repository->destroy($this->uuid);
                if ($result) event(new DeleteEvent($team));
            }
            return $team->id;
        }catch (Exception $exception){
            throw new Exception($exception);
        }
    }
}
