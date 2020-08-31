<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * Class Permission.
 *
 * @package namespace App\Repositories\Models;
 */
class Permission extends SpatiePermission
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $guarded = [
        'id'
    ];
}
