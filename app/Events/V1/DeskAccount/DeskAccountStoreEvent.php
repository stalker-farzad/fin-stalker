<?php

namespace App\Events\V1\DeskAccount;

use App\Models\DalanCapital\V1\DeskAccount;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeskAccountStoreEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param DeskAccount $deskAccount
     */
    public function __construct(public DeskAccount $deskAccount) { }
}
