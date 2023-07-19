<?php

namespace App\Http\Controllers\V1\Desk;

use Briofy\RestLaravel\Http\Controllers\RestController;
use App\Http\Resources\V1\Desk\IndexResource;
use App\Http\Resources\V1\Desk\SingleResource;
use Illuminate\Http\JsonResponse;
use App\Jobs\V1\Desk\ReadJob;
use App\Jobs\V1\Desk\GetJob;
use Illuminate\Http\Request;

class DeskController extends RestController
{
    private const USERID = 'uuid';

    public function __construct() {}

    public function index(Request $request) : JsonResponse
    {
        try {
            $data = $request->only([
                'title', 'description', 'content', 'logo', 'cover',
                'aum_amount', 'aum_currency', 'status', 'synced_at'
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
        try {
            return $this->respond(
                SingleResource::make(dispatch_sync(new ReadJob($uuid)))
            );
        }catch (\Exception $e) {
            return $this->respondWithError($e);
        }
    }
}
