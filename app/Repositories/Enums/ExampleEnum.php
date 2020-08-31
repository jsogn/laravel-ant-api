<?php
namespace App\Repositories\Enums;

use App\Contracts\Enums\LocalizedEnumContract;
use App\Support\Enum\Enum;

class ExampleEnum extends Enum implements LocalizedEnumContract
{
    const ADMINISTRATOR = 1;

    const MODERATOR = 0;

    const SUPER_ADMINISTRATOR = 2;
}
