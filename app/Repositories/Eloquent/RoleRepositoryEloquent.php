<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Models\Role;
use App\Contracts\Repositories\RoleRepository;
use App\Repositories\Validators\RoleValidator;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class RoleRepositoryEloquent.
 */
class RoleRepositoryEloquent extends BaseRepositoryEloquent implements RoleRepository
{
    /**
     * 指定模型类名
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * 指定验证器类名
     *
     * @return mixed
     */
    public function validator()
    {
        return RoleValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     *
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
