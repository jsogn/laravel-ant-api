<?php

namespace App\Http\Controllers\admin;

use App\Services\RoleService;
use App\Services\PermissionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * @var PermissionService
    */
    private $permissionService;

    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->middleware('auth:admin');
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    public function list()
    {
        $roles = $this->roleService->list();
        $rules = $this->permissionService->getMenuPermission();
        $menus = $this->permissionService->getMenuTree();

        return $this->response->success(compact('roles', 'rules', 'menus'));
    }

    public function store(RoleCreateRequest $request)
    {
        return $this->response->success($this->roleService->store($request));
    }

    public function update(int $id, RoleUpdateRequest $request)
    {
        return $this->response->success($this->roleService->update($request, $id));
    }

    public function destroy(int $id)
    {
        return $this->response->success($this->roleService->destroy($id));
    }
}
