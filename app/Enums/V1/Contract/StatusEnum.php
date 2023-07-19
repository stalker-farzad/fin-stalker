<?php

namespace App\Enums\V1\Contract;

use App\Enums\V1\EnumTrait;

enum StatusEnum: int
{
    use EnumTrait;

    case ACTIVE = 14000;
    case INACTIVE = 14001;
}
