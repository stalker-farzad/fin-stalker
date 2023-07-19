<?php

namespace App\Jobs\V1\Desk;

use App\Repositories\V1\Desk\IDeskRepository;
use App\Models\DalanCapital\V1\Desk;
use App\Jobs\SyncJob;
use Exception;

class GetJob extends SyncJob
{
    private IDeskRepository $repository;

    /**
     * @param  array  $data
     */
    public function __construct(
        private array $data ,
    ) {
        $this->repository = app()->make(IDeskRepository::class);
    }

    /**
     * @param  array  $data
     *
     * @return Desk
     * @throws Exception
     */
    public function handle()
    {
        try {

            return $this->repository->index($this->data);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
