<?php

namespace App\Http\Controllers\V1\my\Desk;

use App\Http\Requests\V1\Desk\Account\StoreAccountRequest;
use App\Http\Requests\V1\Desk\Account\UpdateAccountRequest;
use App\Http\Resources\V1\Desk\Account\IndexResource;
use App\Http\Resources\V1\Desk\Account\SingleResource;
use App\Jobs\V1\my\Desk\Account\DeleteAccountJob;
use App\Jobs\V1\my\Desk\Account\GetAccountJob;
use App\Jobs\V1\my\Desk\Account\ReadAccountJob;
use App\Jobs\V1\my\Desk\Account\StoreAccountJob;
use App\Jobs\V1\my\Desk\Account\UpdateAccountJob;
use Briofy\RestLaravel\Http\Controllers\RestController;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends RestController
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        try{
            $attributes = $request->only([ 'desk_id', 'title', 'is_public', 'type', 'status' ]);
            $user_id    = $request->user()['uuid'];
            return $this->respond(IndexResource::collection(dispatch_sync(new GetAccountJob($user_id, $attributes))));
        }catch (Exception $e){
            return $this->respondWithError($e);
        }
    }

    /**
     * @param string $uuid
     *
     * @return JsonResponse
     */
    public function show(string $uuid) : JsonResponse
    {
        try{
            return $this->respond(SingleResource::make(dispatch_sync(new ReadAccountJob($uuid))));
        }catch (Exception $e){
            return $this->respondWithError($e);
        }
    }

    /**
     * @param StoreAccountRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreAccountRequest $request) : JsonResponse
    {
        try{
            $attributes = $request->validated();
            $user_id    = $request->user()['uuid'];
            return $this->respond(SingleResource::make(dispatch_sync(new StoreAccountJob($user_id, $attributes))));
        }catch (Exception $e){
            return $this->respondWithError($e);
        }
    }

    /**
     * @param UpdateAccountRequest $request
     * @param string                   $uuid
     *
     * @return JsonResponse
     */
    public function update(UpdateAccountRequest $request, string $uuid) : JsonResponse
    {
        try{
            $result = dispatch_sync(new UpdateAccountJob($uuid, $request->validated()));
            return $this->respond(SingleResource::make($result));
        }catch (Exception $e){
            return $this->respondWithError($e);
        }
    }

    /**
     * @param string $uuid
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function destroy(string $uuid) : JsonResponse
    {
        try{
            return $this->respondEntityRemoved(dispatch_sync(new DeleteAccountJob($uuid)));
        }catch (Exception $e){
            return $this->respondWithError($e);
        }
    }
}
