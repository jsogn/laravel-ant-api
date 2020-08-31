<?php

namespace App\Http\Controllers\admin;

use App\Services\RoleService;
use App\Services\AdminService;
use App\Services\PermissionService;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;

class AdminController extends Controller
{
    /**
     * @var AdminService
     */
    private $adminService;

    /**
     * @var PermissionService
     */
    private $permissionService;

    /**
     * @var RoleService
     */
    private $roleService;

    public function __construct(AdminService $adminService, PermissionService $permissionService, RoleService $roleService)
    {
        $this->middleware('auth:admin');

        $this->adminService = $adminService;
        $this->permissionService = $permissionService;
        $this->roleService = $roleService;
    }

    public function show()
    {
        $user = $this->adminService->show(auth('admin')->id());
        $user->menus = $this->permissionService->getRouteMenuTree();
        $user->permissions = $this->permissionService->getPermissionTreeByUser($user);

        return $this->response->success($user);
    }

    public function list()
    {
        $users = $this->adminService->list();
        $rules = $this->permissionService->getMenuPermission();
        $roles = $this->roleService->list();

        return $this->response->success(compact('users', 'rules', 'roles'));
    }

    public function destroy(int $id)
    {
        return $this->response->success($this->adminService->destroy($id));
    }

    public function update(int $id, AdminUpdateRequest $request)
    {
        return $this->response->success($this->adminService->update($request->validated(), $id));
    }

    public function store(AdminCreateRequest $request)
    {
        $admin = $this->adminService->store($request);

        return $this->response->created(new AdminResource($admin));
    }

    public function modify(AdminUpdateRequest $request)
    {
        return $this->response->success($this->adminService->update($request->validated(), $request->user()->id));
    }
}
