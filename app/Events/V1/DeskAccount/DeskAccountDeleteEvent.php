<?php

namespace App\Events\V1\DeskAccount;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeskAccountDeleteEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid) { }
}
