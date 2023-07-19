<?php

namespace App\Jobs\V1\my\Desk;

use App\Repositories\V1\my\Desk\IDeskRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Jobs\SyncJob;
use Exception;

class GetJob extends SyncJob
{
    private IDeskRepository $repository;

    /**
     * @param  string  $userId
     * @param  array  $data
     */
    public function __construct(
        private string $userId,
        private array $data ,
    ) {
        $this->repository = app()->make(IDeskRepository::class);
    }

    /**
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function handle() : LengthAwarePaginator
    {
        try {

            return $this->repository->index($this->userId , $this->data);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
