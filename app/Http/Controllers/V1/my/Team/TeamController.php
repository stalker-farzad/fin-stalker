<?php

namespace App\Http\Controllers\V1\my\Team;

use App\Http\Requests\V1\my\Team\CreateRequest;
use App\Http\Requests\V1\my\Team\UpdateRequest;
use App\Http\Resources\V1\Team\IndexResource;
use App\Http\Resources\V1\Team\SingleResource;
use App\Jobs\V1\my\Team\DeleteJob;
use App\Jobs\V1\my\Team\IndexJob;
use App\Jobs\V1\my\Team\SingleJob;
use App\Jobs\V1\my\Team\StoreJob;
use App\Jobs\V1\my\Team\UpdateJob;
use Briofy\RestLaravel\Http\Controllers\RestController;
use Exception;
use Illuminate\Http\Request;

class TeamController extends RestController
{
    public function index(Request $request)
    {
        try{
            $data = $request->only([
                'title', 'description', 'content', 'logo', 'cover',
                'aum_amount', 'aum_currency', 'status', 'synced_at'
            ]);
            return $this->respond(IndexResource::collection(dispatch_sync(new IndexJob($data, $request->user()['uuid']))));
        }catch (Exception $exception){
            return $this->respondWithError($exception);
        }

    }

    public function show(Request $request, $uuid)
    {
        try {
            return $this->respond(SingleResource::make(dispatch_sync(new SingleJob($request->user()['uuid'], $uuid))));
        }catch (Exception $exception){
            return $this->respondWithError($exception);
        }
    }

    public function store(CreateRequest $request)
    {
        try {
            return $this->respond(SingleResource::make(dispatch_sync(new StoreJob(
                $request->user()['uuid'], $request->validated()))));
        }catch(Exception $exception){
            return $this->respondWithError($exception);
        }
    }

    public function update(UpdateRequest $request, $uuid)
    {
        try {
            return $this->respond(SingleResource::make(dispatch_sync(new UpdateJob($request->validated(), $uuid))));
        }catch (Exception $exception){
            return $this->respondWithError($exception);
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            return $this->respondEntityRemoved(dispatch_sync(new DeleteJob($uuid, $request->user()['uuid'])));
        }catch (Exception $exception){
            return $this->respondWithError($exception);
        }
    }
}
