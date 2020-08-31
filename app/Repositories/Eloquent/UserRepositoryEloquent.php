<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Support\Helper\RandomProfileHelper;
use App\Contracts\Repositories\UserRepository;
use App\Repositories\Validators\UserValidator;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserRepositoryEloquent.
 */
class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{
    protected $fieldSearchable = [
        'account' => 'like',
        'phone',
    ];

    /**
     * 指定模型类名
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * 指定验证器类名
     *
     * @return mixed
     */
    public function validator()
    {
        return UserValidator::class;
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

    public function searchUsersByPage(int $limit = 5)
    {
        return $this->paginate($limit);
    }

    public function findUserById($id)
    {
        return $this->find($id);
    }

    /**
     * 插入用户数据
     *
     * @param array $attributes
     */
    public function insertUser(array $attributes)
    {
        $this->model->account  = $attributes['account'];
        $this->model->phone    = $attributes['phone'];
        $this->model->password = Hash::make($attributes['password']);
        $this->model->nickname = RandomProfileHelper::nickname();
        $this->model->avatar   = RandomProfileHelper::avatar();
        $this->model->saveOrFail();

        return $this->model;
    }

    // 是否超级管理员
    public function isSuper()
    {
        return $this->id === config('permission.super_id');
    }
}
