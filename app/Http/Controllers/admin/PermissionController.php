<?php

namespace App\Http\Controllers\admin;

use App\Services\AdminService;
use App\Services\PermissionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionFromRequest;

class PermissionController extends Controller
{
    /**
     * @var AdminService
     */
    private $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $info = $this->adminService->info();

        return $this->response->success($info);
    }

    public function list()
    {
        return $this->response->success($this->permissionService->list());
    }

    public function update(int $id, PermissionFromRequest $request)
    {
        $res = $this->permissionService->save($request, $id);

        return $this->response->success($res);
    }

    public function store(PermissionFromRequest $request)
    {
        $res = $this->permissionService->save($request);

        return $this->response->success($res);
    }

    public function destroy(int $id)
    {
        $this->permissionService->destroy($id);

        return $this->response->noContent();
    }
}
