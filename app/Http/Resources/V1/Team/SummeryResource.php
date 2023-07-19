<?php

namespace App\Http\Resources\V1\Team;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SummeryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid'  => $this->id,
            'title' => $this->title,
        ];
    }
}
