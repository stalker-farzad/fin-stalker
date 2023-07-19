<?php

namespace App\Http\Resources\V1\Desk\Account;

use Illuminate\Http\Resources\Json\JsonResource;

class SummeryResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'uuid'     => $this->id,
            'title'    => $this->title,
        ];
    }
}
