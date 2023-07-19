<?php

namespace App\Events\V1\my\Contract;

use App\Models\DalanCapital\V1\Contract;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  Contract  $contract
     */
    public function __construct(
        public Contract $contract
    ) {
    }
}
