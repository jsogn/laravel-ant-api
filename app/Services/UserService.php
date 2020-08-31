<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\Criteria\UserCriteria;
use App\Contracts\Repositories\UserRepository;
use App\Repositories\Presenters\UserPresenter;
use App\Repositories\Presenters\HandleLogPresenter;
use App\Repositories\Eloquent\UserRepositoryEloquent;

class UserService
{
    private $repository;

    /**
     * @param  UserRepositoryEloquent  $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list(Request $request)
    {
        $this->repository->pushCriteria(new UserCriteria($request));
        $this->repository->setPresenter(HandleLogPresenter::class);

        return $this->repository->queryPaginate();
    }

    public function profile($id)
    {
        $this->repository->setPresenter(UserPresenter::class);

        return $this->repository->findUserById($id);
    }

    public function registration(Request $request)
    {
        return $this->repository->insertUser($request->all());
    }
}
