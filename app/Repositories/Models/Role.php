<?php

namespace App\Repositories\Models;

use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Class Permission.
 *
 * @package namespace App\Repositories\Models;
 */
class Role extends SpatieRole
{
    use DatetimeFormat;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
}
