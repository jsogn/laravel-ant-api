<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Models\Permission;
use App\Repositories\Enums\DatabaseEnum;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\PermissionRepository;
use App\Repositories\Validators\PermissionValidator;

/**
 * Class PermissionRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return PermissionValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getMenus()
    {
        return $this->where('type', '=', 'menu')
        ->orderBy('weight', 'desc')
        ->get();
    }

    public function getActions()
    {
        return $this->where('type', '=', 'action')->get();
    }
}
