<?php

namespace App\Http\Controllers\V1\Team;

use App\Http\Requests\V1\Team\Trader\StoreRequest;
use App\Http\Resources\V1\Team\Trader\TeamTraderListResource;
use App\Http\Resources\V1\Team\Trader\TeamTraderSingleResource;
use App\Jobs\V1\Team\TeamTrader\ShowJob;
use App\Jobs\V1\Team\TeamTrader\StoreJob;
use Briofy\RestLaravel\Http\Controllers\RestController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Jobs\V1\Team\TeamTrader\IndexJob;


class TraderController extends RestController
{
    public function index(Request $request):JsonResponse
    {
        try
        {
            $data = array_merge($request->only
            ([   'team_id', 'content', 'share', 'profits', 'harvestable', 'harvested', 'priority',
                'aum_amount', 'aum_currency', 'is_hireable', 'is_public','type', 'status', 'synced_at']), [
                'user_id' => $request->user()['uuid'],
            ]);
            return $this->respond(TeamTraderListResource::collection(dispatch_sync(new IndexJob($data))));

        }catch (\Exception $exception)
        {
            return $this->respondWithError($exception);
        }

    }

    public function store(StoreRequest $request):JsonResponse
    {
        try
        {
            return $this->respond(dispatch_sync(new StoreJob($request->validated())));

        }catch (\Exception $exception)
        {
            return $this->respondWithError($exception);
        }

    }
    public function show(Request $request , $uuid):JsonResponse
    {
        try
        {
            return $this->respond(TeamTraderSingleResource::make(dispatch_sync(new ShowJob($uuid))));

        }catch (\Exception $exception){
            return $this->respondWithError($exception);
        }

    }
}
