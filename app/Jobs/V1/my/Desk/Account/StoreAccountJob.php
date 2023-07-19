<?php

namespace App\Jobs\V1\my\Desk\Account;

use App\Enums\V1\Desk\Account\TypeEnum;
use App\Enums\V1\Desk\StatusEnum;
use App\Events\V1\DeskAccount\DeskAccountStoreEvent;
use App\Jobs\SyncJob;
use App\Models\DalanCapital\V1\DeskAccount;
use App\Repositories\V1\my\Desk\Account\IAccountRepository;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class StoreAccountJob extends SyncJob
{
    private IAccountRepository $repository;

    /**
     * @param array $attributes
     *
     * @throws BindingResolutionException
     */
    public function __construct(private string $user_id, private array $attributes)
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
            $this->attributes['status'] = \App\Enums\V1\Desk\Account\StatusEnum::ACTIVE->value;
            $this->attributes['type'] = TypeEnum::PERSONAL->value;
            $this->attributes['user_id'] = $this->user_id;

            $result = $this->repository->create($this->attributes);
            if ( $result )
                event(new DeskAccountStoreEvent($result));
            return $result;
        } catch ( Exception $exception ) {
            throw new Exception($exception->getMessage());
        }
    }
}
