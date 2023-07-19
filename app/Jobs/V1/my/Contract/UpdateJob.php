<?php

namespace App\Jobs\V1\my\Contract;

use App\Events\V1\my\Contract\UpdateEvent;
use App\Models\DalanCapital\V1\Contract;
use App\Repositories\V1\my\Contract\ContractRepository;
use App\Jobs\SyncJob;
use Exception;

class UpdateJob extends SyncJob
{
    private $repository;
    /**
     * @param  string  $uuid
     * @param  array  $data
     */
    public function __construct(
        private string $uuid,
        private array $data
    ) {
        $this->repository = new ContractRepository();
    }

    /**
     *
     * @return Contract
     * @throws Exception
     */
    public function handle(): Contract
    {
        try {

            $contract = $this->repository->findOrFail($this->uuid);

            $contract = $this->repository->transactional(fn() => $this->repository->update($contract->id, $this->data));

            if(isset($contract)){
                UpdateEvent::dispatch($contract);

                return $contract;
            }else{
                return [];
            }

        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
