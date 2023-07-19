<?php

namespace App\Enums\V1\Desk\Account;

use App\Enums\V1\EnumTrait;

enum TypeEnum: int
{
    use EnumTrait;

    case PERSONAL = 10500;
    case FUNDED = 10501;
}
