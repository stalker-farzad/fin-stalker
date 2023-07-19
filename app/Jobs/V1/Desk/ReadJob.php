<?php

namespace App\Jobs\V1\Desk;

use App\Repositories\V1\Desk\IDeskRepository;
use App\Models\DalanCapital\V1\Desk;
use App\Jobs\SyncJob;
use Exception;

class ReadJob extends SyncJob
{
    private IDeskRepository $repository;

    /**
     * @param  string  $uuid
     */
    public function __construct(
        private string $uuid ,
    ) {
        $this->repository = app()->make(IDeskRepository::class);
    }

    /**
     * @param  string  $uuid
     *
     * @return Desk
     * @throws Exception
     */
    public function handle()
    {
        try {

            return $this->repository->show($this->uuid);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
