<?php
namespace App\Repositories\Enums;

use App\Contracts\Enums\LocalizedEnumContract;
use App\Support\Enum\Enum;

class DatabaseEnum extends Enum implements LocalizedEnumContract
{
    const PERMISSION_STATUS_NORMAL = 1;
}
