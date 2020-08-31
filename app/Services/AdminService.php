<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Contracts\Repositories\AdminRepository;
use App\Repositories\Eloquent\AdminRepositoryEloquent;

class AdminService
{
    private $repository;

    /**
     * @param  AdminRepositoryEloquent  $repository
     */
    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        $list = $this->repository->where('id', '<>', config('permission.super_id'))->get();
        foreach($list as $item) {
            $item->rules = $item->role->permissions()->pluck('id');
        }

        return $list;
    }

    public function show(int $id)
    {
        return $this->repository->find($id);
    }

    public function store(AdminCreateRequest $request)
    {
        return $this->repository->insertAdmin($request->validated());
    }

    public function destroy(int $id)
    {
        return $this->repository->delete($id);
    }

    public function update(array $data, int $id)
    {
        if (!empty($data['password'])) $data['password'] = Hash::make($data['password']);

        return $this->repository->update($data, $id);
    }
}
