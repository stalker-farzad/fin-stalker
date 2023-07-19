<?php

namespace App\Jobs\V1\Contract;

use App\Repositories\V1\Contract\IContractRepository;
use App\Models\DalanCapital\V1\Contract;
use App\Jobs\SyncJob;
use Exception;

class ReadJob extends SyncJob
{
    private IContractRepository $repository;

    /**
     * @param  string  $uuid
     */
    public function __construct(
        private string $uuid ,
    ) {
        $this->repository = app()->make(IContractRepository::class);
    }

    /**
     * @param  string  $uuid
     *
     * @return Contract
     * @throws Exception
     */
    public function handle() : Contract
    {
        try {

            return $this->repository->show($this->uuid);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
