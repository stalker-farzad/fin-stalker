<?php

namespace App\Http\Controllers\V1\my\Desk;

use App\Http\Requests\V1\Desk\CreateRequest;
use Briofy\RestLaravel\Http\Controllers\RestController;
use App\Http\Requests\V1\Desk\UpdateRequest;
use App\Http\Resources\V1\Desk\IndexResource;
use App\Http\Resources\V1\Desk\SingleResource;
use App\Jobs\V1\my\Desk\DeleteJob;
use App\Jobs\V1\my\Desk\UpdateJob;
use App\Jobs\V1\my\Desk\ReadJob;
use App\Jobs\V1\my\Desk\GetJob;
use App\Jobs\V1\my\Desk\CreateJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeskController extends RestController
{
    private const USERID = 'uuid';

    public function __construct() {}

    public function index(Request $request) : JsonResponse
    {
        try{
            $data = $request->only([
                'title', 'description', 'content', 'logo', 'cover',
                'aum_amount', 'aum_currency', 'status', 'synced_at'
            ]);

            return $this->respond(
                IndexResource::collection(dispatch_sync(new GetJob($request->user()[self::USERID] , $data)))
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }

    public function show(Request $request , $uuid)
    {
        try{
            return $this->respond(
                SingleResource::make(dispatch_sync(new ReadJob($uuid , $request->user()[self::USERID])))
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }


    public function store(CreateRequest $request): JsonResponse
    {
        try{
            return $this->respond(
                SingleResource::make(dispatch_sync(new CreateJob($request->validated() , $request->user()[self::USERID])))
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }


    public function update(UpdateRequest $request, $uuid): JsonResponse
    {
        try{
            return $this->respond(
                SingleResource::make(dispatch_sync(new UpdateJob($uuid, $request->validated())))
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }


    public function destroy($uuid): JsonResponse
    {
        try{
            return $this->respondEntityRemoved(dispatch_sync(new DeleteJob($uuid)));
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }
}

