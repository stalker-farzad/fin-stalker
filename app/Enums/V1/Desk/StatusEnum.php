<?php

namespace App\Enums\V1\Desk;

use App\Enums\V1\EnumTrait;

enum StatusEnum: int
{
    use EnumTrait;

    case ACTIVE = 10000;
    case INACTIVE = 10001;
}
