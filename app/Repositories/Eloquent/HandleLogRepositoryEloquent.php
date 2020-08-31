<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\HandleLogRepository;
use App\Repositories\Models\HandleLog;
use App\Repositories\Validators\HandleLogValidator;

/**
 * ClassHandleLogRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class HandleLogRepositoryEloquent extends BaseRepositoryEloquent implements HandleLogRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HandleLog::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return HandleLogValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
