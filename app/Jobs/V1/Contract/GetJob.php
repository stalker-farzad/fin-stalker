<?php

namespace App\Jobs\V1\Contract;

use App\Repositories\V1\Contract\IContractRepository;
use App\Jobs\SyncJob;
use Exception;

class GetJob extends SyncJob
{
    private IContractRepository $repository;

    /**
     * @param  array  $data
     */
    public function __construct(
        private array $data ,
    ) {
        $this->repository = app()->make(IContractRepository::class);
    }

    /**
     * @param  array  $data
     *
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
