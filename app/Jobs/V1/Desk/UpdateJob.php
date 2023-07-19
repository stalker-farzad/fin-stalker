<?php

namespace App\Jobs\V1\Desk;

use App\Events\V1\Desk\UpdateEvent;
use App\Models\DalanCapital\V1\Desk;
use App\Repositories\V1\Desk\DeskRepository;
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
        $this->repository = new DeskRepository();
    }

    /**
     *
     * @return Desk
     * @throws Exception
     */
    public function handle(): Desk
    {
        try {

            $desk = $this->repository->findOrFail($this->uuid);

            $desk = $this->repository->transactional(fn() => $this->repository->update($desk->id, $this->data));

            if(isset($desk)){
                UpdateEvent::dispatch($desk);

                return $desk;
            }else{
                return [];
            }

        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
