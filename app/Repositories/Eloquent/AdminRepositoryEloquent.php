<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Repositories\AdminRepository;
use App\Repositories\Validators\AdminValidator;
use App\Support\Helper\RandomProfileHelper;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class AdminRepositoryEloquent.
 */
class AdminRepositoryEloquent extends BaseRepositoryEloquent implements AdminRepository
{
    protected $fieldSearchable = [
        'account' => 'like',
    ];

    /**
     * 指定模型类名
     *
     * @return string
     */
    public function model()
    {
        return Admin::class;
    }

    /**
     * 指定验证器类名
     *
     * @return mixed
     */
    public function validator()
    {
        return AdminValidator::class;
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
    public function insertAdmin(array $attributes)
    {
        $this->model->account  = $attributes['account'];
        $this->model->password = Hash::make($attributes['password']);
        $this->model->nickname = $attributes['nickname'];
        $this->model->status   = $attributes['status'];
        $this->model->role_id  = $attributes['role_id'];
        $this->model->avatar   = RandomProfileHelper::avatar();
        $this->model->saveOrFail();

        return $this->model;
    }
}
