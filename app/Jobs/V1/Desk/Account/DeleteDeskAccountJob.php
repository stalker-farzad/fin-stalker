<?php

namespace App\Jobs\V1\Desk\Account;

use App\Events\V1\DeskAccount\DeskAccountDeleteEvent;
use App\Jobs\SyncJob;
use App\Repositories\V1\Desk\Account\IAccountRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class DeleteDeskAccountJob extends SyncJob
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
     * @return string
     * @throws Exception
     */
    public function handle() : string
    {
        try {
            $result = $this->repository->destroy($this->uuid);
            if ( $result )
                event(new DeskAccountDeleteEvent($this->uuid));
            return $result;
        } catch ( Exception $e ) {
            throw new Exception($e->getMessage());
        }
    }
}
