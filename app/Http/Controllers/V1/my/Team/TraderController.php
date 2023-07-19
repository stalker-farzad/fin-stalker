<?php

namespace App\Http\Controllers\V1\my\Team;

use App\Http\Requests\V1\Team\Trader\StoreRequest;
use App\Http\Requests\V1\Team\Trader\UpdateRequest;
use App\Http\Resources\V1\Team\Trader\TeamTraderListResource;
use App\Http\Resources\V1\Team\Trader\TeamTraderSingleResource;
use App\Jobs\V1\my\TeamTrader\DeleteJob;
use App\Jobs\V1\my\TeamTrader\IndexJob;
use App\Jobs\V1\my\TeamTrader\ShowJob;
use App\Jobs\V1\my\TeamTrader\UpdateJob;
use Briofy\RestLaravel\Http\Controllers\RestController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Jobs\V1\my\TeamTrader\StoreJob;


class TraderController extends RestController
{
    public function index(Request $request) : JsonResponse
    {
        try
        {
            $user_id = $request->user()['uuid'];
            $data = $request->only(['team_id','content','share','profits','harvestable','status','synced_at',
                'harvested','priority','aum_amount','aum_currency', 'is_hireable','is_public','type']);
            return $this->respond(TeamTraderListResource::collection(dispatch_sync(new IndexJob( $user_id , $data ))));
        }catch(Exception $exception){
            return $this->respondWithError($exception);
        }
    }

    public function show(Request $request , $uuid)
    {
        try {
            return $this->respond(TeamTraderSingleResource::make(dispatch_sync(new ShowJob($request->user()['uuid'], $uuid))));
        }catch(Exception $exception){
            return $this->respondWithError($exception);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $data = array_merge($request->only
            ([   'team_id', 'content', 'share', 'profits', 'harvestable', 'harvested', 'priority',
                'aum_amount', 'aum_currency', 'is_hireable', 'is_public','type', 'status', 'synced_at']), [
                'user_id' => $request->user()['uuid'],
            ]);
            return $this->respond(TeamTraderSingleResource::make(dispatch_sync(new StoreJob($data))));
        }catch(Exception $exception){
            return $this->respondWithError($exception);
        }
    }

    public function update(UpdateRequest $request ,$uuid)
    {
        try {
            $data = $request->only(['content', 'share', 'profits', 'harvestable', 'harvested', 'priority',
                'aum_amount', 'aum_currency', 'is_hireable', 'is_public','type', 'status', 'synced_at']);
            $user_id = $request->user()['uuid'];
            return $this->respond(dispatch_sync(new UpdateJob($data,$uuid,$user_id)));
        }catch (\Exception $exception)
        {
            return $this->respondWithError($exception);
        }
    }

    public function destroy(Request $request , $uuid)
    {
        try
        {
            $user_id = $request->user()['uuid'];
            return $this->respond(dispatch_sync(new DeleteJob($user_id,$uuid)));
        }catch (\Exception $exception)
        {
            return $this->respondWithError($exception);
        }
    }
}
