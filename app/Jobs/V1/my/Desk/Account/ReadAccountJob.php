<?php

namespace App\Jobs\V1\my\Desk\Account;

use App\Jobs\SyncJob;
use App\Models\DalanCapital\V1\DeskAccount;
use App\Repositories\V1\my\Desk\Account\IAccountRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class ReadAccountJob extends SyncJob
{
    private IAccountRepository $repository;

    /**
     * @param string $uuid
     *
     * @throws BindingResolutionException
     */
    public function __construct(private readonly string $uuid)
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
            return $this->repository->show($this->uuid);
        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
