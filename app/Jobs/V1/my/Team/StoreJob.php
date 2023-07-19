<?php

namespace App\Jobs\V1\my\Team;

use App\Events\V1\Team\StoreEvent;
use App\Jobs\SyncJob;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\V1\my\Team\ITeamRepository as MyITeamRepository;

class StoreJob extends SyncJob
{
    private MyITeamRepository $teamRepository;

    /**
     * Create a new job instance.
     * @throws BindingResolutionException
     */
    public function __construct(
        public readonly string  $usr,
        public array $data
    )
    {
        $this->teamRepository = app()->make(MyITeamRepository::class);
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(): Model
    {
        try {
            $this->data['user_id']= $this->usr;
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
