<?php

namespace App\Http\Controllers\V1\Team;

use App\Http\Requests\V1\Team\CreateRequest;
use App\Http\Requests\V1\Team\UpdateRequest;
use App\Http\Resources\V1\Team\IndexResource;
use App\Http\Resources\V1\Team\SingleResource;
use App\Jobs\V1\Team\DeleteJob;
use App\Jobs\V1\Team\IndexJob;
use App\Jobs\V1\Team\SingleJob;
use App\Jobs\V1\Team\StoreJob;
use App\Jobs\V1\Team\UpdateJob;
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

            return $this->respond(IndexResource::collection(dispatch_sync(new IndexJob($data))));

        }catch (Exception $exception){
            return $this->respondWithError($exception);

        }

    }

    public function show($uuid)
    {
        try {

            return $this->respond(SingleResource::make(dispatch_sync(new SingleJob($uuid))));

        }catch (Exception $exception){

            return $this->respondWithError($exception);

        }
    }
}
