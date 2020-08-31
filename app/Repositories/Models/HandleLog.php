<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * ClassHandleLog.
 *
 * @package namespace App\Repositories\Models;
 */
class HandleLog extends Model implements Transformable
{
    use TransformableTrait;
    use DatetimeFormat;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    protected $guarded  = [];
}
