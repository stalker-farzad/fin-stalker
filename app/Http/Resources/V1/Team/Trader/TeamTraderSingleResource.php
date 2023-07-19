<?php

namespace App\Http\Resources\V1\Team\Trader;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class TeamTraderSingleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid'              => $this->id,
            'team_id'           => $this->team_id,
            'content'           => $this->content,
            'share'             => $this->share,
            'profits'           => $this->profits,
            'harvestable'       => $this->harvestable,
            'harvested'         => $this->harvested,
            'priority'          => $this->priority,
            'aum_amount'        => $this->aum_amount,
            'aum_currency'      => $this->aum_currency,
            'is_public'         => $this->is_public,
            'status'            => $this->status,
            'synced_at'         => $this->synced_at
        ];
    }
}
