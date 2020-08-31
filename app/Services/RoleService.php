<?php
namespace App\Services;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Contracts\Repositories\RoleRepository;
use App\Repositories\Eloquent\RoleRepositoryEloquent;

class RoleService
{
    private $repository;

    /**
     * @param  RoleRepositoryEloquent  $repository
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        $list = $this->repository->get();
        foreach ($list as $item) $item->permissions = $item->permissions()->pluck('id');

        return $list;
    }

    public function store(RoleCreateRequest $request)
    {
        $role = $this->repository->create($request->except(['rules']));
        $role->givePermissionTo($request->rules);

        return $role;
    }

    public function update(RoleUpdateRequest $request, int $id)
    {
        $role = $this->repository->update($request->except(['rules']), $id);
        $role->syncPermissions($request->rules);

        return $role;
    }

    public function destroy(int $id)
    {
        return $this->repository->delete($id);
    }
}
