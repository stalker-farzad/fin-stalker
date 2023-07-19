<?php

namespace App\Jobs\V1\my\Desk\Account;

use App\Events\V1\DeskAccount\DeskAccountUpdateEvent;
use App\Jobs\SyncJob;
use App\Models\DalanCapital\V1\DeskAccount;
use App\Repositories\V1\my\Desk\Account\IAccountRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class UpdateAccountJob extends SyncJob
{
    private IAccountRepository $repository;

    /**
     * @param string $uuid
     * @param array  $attributes
     *
     * @throws BindingResolutionException
     */
    public function __construct(private readonly string $uuid, private readonly array $attributes)
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
            $result = $this->repository->update($this->uuid, $this->attributes);
            if ( $result )
                event(new DeskAccountUpdateEvent($result));
            return $result;
        } catch ( Exception $exception ) {
            throw new Exception($exception->getMessage());
        }
    }
}
