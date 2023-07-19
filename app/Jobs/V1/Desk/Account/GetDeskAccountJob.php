<?php

namespace App\Jobs\V1\Desk\Account;

use App\Jobs\SyncJob;
use App\Repositories\V1\Desk\Account\IAccountRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Pagination\LengthAwarePaginator;

class GetDeskAccountJob extends SyncJob
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
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function handle() : LengthAwarePaginator
    {
        try {
            return $this->repository->index($this->attributes);
        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
