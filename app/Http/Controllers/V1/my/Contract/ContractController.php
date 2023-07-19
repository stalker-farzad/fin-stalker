<?php

namespace App\Http\Controllers\V1\my\Contract;

use App\Http\Requests\V1\Contract\UpdateRequest;
use Briofy\RestLaravel\Http\Controllers\RestController;
use App\Http\Requests\V1\Contract\CreateRequest;
use App\Http\Resources\V1\Contract\SingleResource;
use App\Http\Resources\V1\Contract\IndexResource;
use App\Jobs\V1\my\Contract\DeleteJob;
use App\Jobs\V1\my\Contract\UpdateJob;
use App\Jobs\V1\my\Contract\CreateJob;
use App\Jobs\V1\my\Contract\ReadJob;
use App\Jobs\V1\my\Contract\GetJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContractController extends RestController
{
    private const USERID = 'uuid';

    public function __construct() {}

    public function index(Request $request) : JsonResponse
    {
        try {
            $data = $request->only([
                'team_id', 'team_trader_id', 'desk_id', 'desk_account_id', 'number', 'title',
                'description', 'share', 'start_balance', 'current_balance', 'currency', 'profits',
                'harvestable', 'harvested', 'scale_up_amount', 'scale_up_times', 'scaled_up_at',
                'target', 'status', 'synced_at'
            ]);

            return $this->respond(
                IndexResource::collection(dispatch_sync(new GetJob($request->user()[self::USERID] ,$data)))
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }

    public function show(Request $request , $uuid): JsonResponse
    {
        try {
            return $this->respond(
                SingleResource::make(dispatch_sync(new ReadJob($uuid , $request->user()[self::USERID])))
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }

    public function store(CreateRequest $request): JsonResponse
    {
        try {
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
