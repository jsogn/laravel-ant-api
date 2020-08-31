<?php
namespace App\Repositories\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class HandleLogCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->request->filled('action')) {
            $model = $model->where('action', 'like', $this->request->get('action'));
        }
        if ($this->request->filled('account')) {
            $model = $model->where('account', '=', $this->request->get('account'));
        }
        if ($this->request->filled('guard')) {
            $model = $model->where('guard_name', $this->request->get('guard'));
        }
        if (!auth('admin')->user()->isSuper()) {
            $model = $model->where('account', auth('admin')->user()->account);
        }

        return $model;
    }
}
