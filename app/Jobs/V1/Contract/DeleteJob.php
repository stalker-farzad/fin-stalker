<?php

namespace App\Jobs\V1\Contract;

use App\Events\V1\Contract\DeleteEvent;
use App\Repositories\V1\Contract\IContractRepository;
use App\Jobs\SyncJob;
use Exception;

class DeleteJob extends SyncJob
{
    private IContractRepository $repository;

    /**
     * @param  string  $contractId
     */
    public function __construct(
        private string $contractId
    ) {
        $this->repository = app()->make(IContractRepository::class);
    }

    /**
     *
     * @return string
     * @throws Exception
     */
    public function handle(): string
    {
        try {

            $contract = $this->repository->destroy($this->contractId);

            if(isset($contract)){
                DeleteEvent::dispatch($this->contractId);

                return $contract;
            }else{
                return [];
            }



        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
