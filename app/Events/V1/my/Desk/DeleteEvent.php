<?php

namespace App\Events\V1\my\Desk;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  string  $deskId
     */
    public function __construct(
        public string $deskId
    ) {
    }
}
