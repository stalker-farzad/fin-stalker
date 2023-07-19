<?php

namespace App\Http\Resources\V1\Desk;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class IndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'          => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'content'       => $this->content,
            'logo'          => $this->getTemporaryUrl($this->logo),
            'cover'         => $this->getTemporaryUrl($this->cover),
            'aum_amount'    => $this->aum_amount,
            'aum_currency'  => $this->aum_currency,
            'is_public'     => $this->is_public,
            'status'        => $this->status,
            'synced_at'     => $this->synced_at
        ];
    }


    public function getTemporaryUrl(?string $path): string | null
    {
        if ($path!=null) return Storage::disk('s3')->temporaryUrl($path, now()->addMinutes(10));
        return null;
    }
}
