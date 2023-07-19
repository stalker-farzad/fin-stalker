<?php

namespace App\Events\V1\my\Desk;

use App\Models\DalanCapital\V1\Desk;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  Desk  $desk
     */
    public function __construct(
        public Desk $desk
    ) {
    }
}
