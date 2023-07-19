<?php

namespace App\Http\Controllers\V1\Contract;

use App\Http\Requests\V1\Contract\UpdateRequest;
use Briofy\RestLaravel\Http\Controllers\RestController;
use App\Http\Requests\V1\Contract\CreateRequest;
use App\Http\Resources\V1\Contract\SingleResource;
use App\Http\Resources\V1\Contract\IndexResource;
use App\Jobs\V1\Contract\DeleteJob;
use App\Jobs\V1\Contract\UpdateJob;
use App\Jobs\V1\Contract\CreateJob;
use App\Jobs\V1\Contract\ReadJob;
use App\Jobs\V1\Contract\GetJob;
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
                IndexResource::collection(dispatch_sync(new GetJob($data)))
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }

    public function show($uuid): JsonResponse
    {
        try{
            return $this->respond(
                SingleResource::make(dispatch_sync(new ReadJob($uuid)))
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }
}
