<?php

namespace App\Jobs\V1\Desk\Account;

use App\Events\V1\DeskAccount\DeskAccountStoreEvent;
use App\Jobs\SyncJob;
use App\Models\DalanCapital\V1\DeskAccount;
use App\Repositories\V1\Desk\Account\IAccountRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class StoreDeskAccountJob extends SyncJob
{
    private IAccountRepository $repository;

    /**
     * @param array $attributes
     *
     * @throws BindingResolutionException
     */
    public function __construct(private readonly array $attributes)
    {
        $this->repository = app()->make(IAccountRepository::class);
    }

    /**
     * @return DeskAccount
     * @throws Exception
     */
    public function handle() : DeskAccount
    {
        try {
            $result = $this->repository->create($this->attributes);
            if ( $result )
                event(new DeskAccountStoreEvent($result));
            return $result;
        } catch ( Exception $exception ) {
            throw new Exception($exception->getMessage());
        }
    }
}
