<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Storage.
 *
 * @package namespace App\Repositories\Models;
 */
class Storage extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $guarded = [];

    // public function getPathAttribute($value)
    // {
    //     return request()->root() .'/'. $value;
    // }
}
