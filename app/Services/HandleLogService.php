<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\Criteria\HandleLogCriteria;
use App\Contracts\Repositories\HandleLogRepository;
use App\Repositories\Presenters\HandleLogPresenter;
use App\Repositories\Eloquent\HandleLogRepositoryEloquent;

class HandleLogService
{
    private $repository;

    /**
     * @param HandleLogRepositoryEloquent  $repository
     */
    public function __construct(HandleLogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list(Request $request)
    {
        $this->repository->pushCriteria(new HandleLogCriteria($request));
        $this->repository->setPresenter(HandleLogPresenter::class);

        return $this->repository->orderBy('id','desc')->queryPaginate();
    }

}
