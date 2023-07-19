<?php

namespace App\Jobs\V1\my\Contract;

use App\Repositories\V1\my\Contract\ContractRepository;
use App\Events\V1\my\Contract\CreateEvent;
use App\Models\DalanCapital\V1\Contract;
use App\Jobs\SyncJob;
use Exception;

class CreateJob extends SyncJob
{
    private $repository;

    /**
     * @param  array  $data
     * @param  string  $userId
     */
    public function __construct(
        private array $data,
        private string $userId
    ) {
        $this->repository = new ContractRepository();
    }

    /**
     * @param  array  $data
     *
     * @return Contract
     * @throws Exception
     */
    public function handle(): Contract
    {
        try {

            $this->data['user_id'] = $this->userId;
            $contract = $this->repository->transactional(fn() => $this->repository->store($this->data));

            if(isset($contract)){
                CreateEvent::dispatch($contract);
                return $contract ;
            } else {
                return [];
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
