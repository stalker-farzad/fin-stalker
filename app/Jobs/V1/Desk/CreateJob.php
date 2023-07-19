<?php

namespace App\Jobs\V1\Desk;

use App\Repositories\V1\Desk\DeskRepository;
use App\Events\V1\Desk\CreateEvent;
use App\Models\DalanCapital\V1\Desk;
use App\Jobs\SyncJob;
use Exception;

class CreateJob extends SyncJob
{
    private $repository;

    /**
     * @param  string  $userId
     * @param  array  $data
     */
    public function __construct(
        private array $data ,
        private string $userId
    ) {
        $this->repository = new DeskRepository();
    }

    /**
     * @param  array  $data
     *
     * @return Desk
     * @throws Exception
     */
    public function handle(): Desk
    {
        try {
            $this->data['user_id'] = $this->userId;

            $desk = $this->repository->transactional(fn() => $this->repository->store($this->data));

            if(isset($desk)){
                CreateEvent::dispatch($desk);
                return $desk ;
            } else {
                return [];
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
