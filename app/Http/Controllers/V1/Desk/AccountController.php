<?php

namespace App\Http\Controllers\V1\Desk;

use App\Http\Resources\V1\Desk\Account\IndexResource;
use App\Http\Resources\V1\Desk\Account\SingleResource;
use App\Jobs\V1\Desk\Account\GetDeskAccountJob;
use App\Jobs\V1\Desk\Account\ReadDeskAccountJob;
use App\Models\DalanCapital\V1\DeskAccount;
use Briofy\RestLaravel\Http\Controllers\RestController;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends RestController
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function index(Request $request)
    {
        try {
            $attributes = $request->only([ 'title', 'type', 'status' ]);
            return $this->respond(IndexResource::collection(dispatch_sync(new GetDeskAccountJob($attributes))));
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }

    /**
     * @param string $uuid
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function show(string $uuid) : JsonResponse
    {
        try {
            return $this->respond(SingleResource::make(dispatch_sync(new ReadDeskAccountJob($uuid))));
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }
}
