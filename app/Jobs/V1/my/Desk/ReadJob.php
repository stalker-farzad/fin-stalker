<?php

namespace App\Jobs\V1\my\Desk;

use App\Repositories\V1\my\Desk\IDeskRepository;
use App\Models\DalanCapital\V1\Desk;
use App\Jobs\SyncJob;
use Exception;

class ReadJob extends SyncJob
{
    private IDeskRepository $repository;

    /**
     * @param  string  $userId
     * @param  string  $uuid
     */
    public function __construct(
        private string $uuid ,
        private string $userId,
    ) {
        $this->repository = app()->make(IDeskRepository::class);
    }

    /**
     * @param  string  $uuid
     * @return Desk
     * @throws Exception
     */
    public function handle() : Desk
    {
        try {

            return $this->repository->show($this->uuid , $this->userId);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
