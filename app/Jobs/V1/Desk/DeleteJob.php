<?php

namespace App\Jobs\V1\Desk;

use App\Events\V1\Desk\DeleteEvent;
use App\Repositories\V1\Desk\IDeskRepository;
use App\Jobs\SyncJob;
use Exception;

class DeleteJob extends SyncJob
{
    private IDeskRepository $repository;

    /**
     * @param  string  $deskId
     */
    public function __construct(
        private string $deskId
    ) {
        $this->repository = app()->make(IDeskRepository::class);
    }

    /**
     *
     * @return string
     * @throws Exception
     */
    public function handle(): string
    {
        try {

            $desk = $this->repository->destroy($this->deskId);

            if(isset($desk)){
                DeleteEvent::dispatch($this->deskId);

                return $desk;
            }else{
                return [];
            }



        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
