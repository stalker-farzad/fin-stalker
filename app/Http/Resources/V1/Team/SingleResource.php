<?php

namespace App\Http\Resources\V1\Team;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'logo' => $this->logo,
            'cover' => $this->cover,
            'aum_amount' => $this->aum_amount,
            'aum_currency' => $this->aum_currency,
            'is_hireable' => $this->is_hireable,
            'is_public' => $this->is_public,
            'status' => $this->status,
            'synced_at' => $this->synced_at,
        ];
    }
}
