<?php
namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\Request;
use Prettus\Repository\Eloquent\BaseRepository;


class BaseRepositoryEloquent extends BaseRepository
{
    public function model()
    {

    }

    // 查询分页
    public function queryPaginate()
    {
        $defaultLimit = config('repository.pagination.limit');

        return $this->paginate(Request::get('limit', $defaultLimit));
    }

}
