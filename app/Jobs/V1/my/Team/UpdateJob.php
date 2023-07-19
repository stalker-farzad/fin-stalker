<?php

namespace App\Jobs\V1\my\Team;

use App\Events\V1\Team\UpdateEvent;
use App\Jobs\SyncJob;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use App\Repositories\V1\my\Team\ITeamRepository as MyITeamRepository;
use Illuminate\Database\Eloquent\Model;

class UpdateJob extends SyncJob
{
    private MyITeamRepository $repository;

    /**
     * Create a new job instance.
     * @throws BindingResolutionException
     */
    public function __construct(
        public array $data,
        public string $uuid,
    )
    {
        $this->repository = app()->make(MyITeamRepository::class);
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(): Model
    {
        try {

            $result = $this->repository->update($this->uuid, $this->data);

            $team = [];

            if ($result) {
                $team = $this->repository->singleByUuid($this->uuid);
                event(new UpdateEvent($team));
            }

            return $team;

        }catch (Exception $exception){
            return dd($exception->getMessage());
            throw new Exception($exception->getMessage());
        }
    }
}
