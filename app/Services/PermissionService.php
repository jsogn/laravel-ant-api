<?php
namespace App\Services;

use App\Repositories\Models\Admin;
use App\Http\Requests\PermissionFromRequest;
use App\Contracts\Repositories\PermissionRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent;

class PermissionService
{
    private $repository;

    /**
     * @param  PermissionRepositoryEloquent  $repository
     */
    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        $data  = $this->formatMenuTreeAction($this->getMenuTree(), $this->repository->getActions()->toArray());
        $tree  = $this->getPermissionTree();

        return compact('data', 'tree');
    }

    public function save(PermissionFromRequest $request, int $id = 0)
    {
        $data       = $request->validated();
        $permission = $data['permission'] ?? '';

        is_array($permission) && $data['permission'] = implode(',', $permission);

        if ($id) return $this->repository->update($data, $id);

        return $this->repository->create($data);
    }

    public function destroy(int $id)
    {
        return $this->repository->delete($id);
    }

    // 获取权限树
    public function getPermissionTree()
    {
        $data = $this->repository->orderBy('pid', 'asc')
        ->orderBy('weight', 'desc')
        ->get();

        return $this->formatTree($data);
    }

    // 获取菜单树
    public function getMenuTree()
    {
        $menus = $this->repository->where('type', '<>', 'action')
        ->orderBy('weight', 'desc')
        ->get();

        return $this->formatTree($menus);
    }

    // 获取路由菜单树
    public function getRouteMenuTree()
    {
        $menus = $this->repository->where('type', '<>', 'action')
        ->where('status', '1')
        ->orderBy('weight', 'desc')
        ->get();

        return $this->formatRoute($this->formatTree($menus), $menus);
    }

    // 获取用户权限树
    public function getPermissionTreeByUser(Admin $user)
    {
        $tree = $this->getPermissionTree();

        return $this->filterPermissionMenu($tree, $user);
    }

    // 递归菜单下的操作
    protected function formatMenuTreeAction(array $menus, array $actions)
    {
        foreach ($menus as $item) {
            if ($item['type'] == 'menu') {
                $item->actions = array_filter($actions, fn($a) => $a['pid'] === $item->id);
            }
            if (!empty($item['children'])) {
                $this->formatMenuTreeAction($item['children'], $actions);
            }
        }
        return $menus;
    }

    //获取菜单与子操作结构.
    public function getMenuPermission()
    {
        $menus   = $this->repository->getMenus();
        $actions = $this->repository->getActions()->toArray();

        foreach ($menus as $item) $item->actions = array_values(array_filter($actions, fn($a) => $a['pid'] === $item->id));

        return $menus;
    }

    // 过滤无权限菜单
    protected function filterPermissionMenu($data, $user)
    {
        $permissions = [];
        foreach ($data as $menu) {
            if ($menu['type'] == 'menu') {
                $permission = [];
                $permission['permissionId'] = $menu['name'];
                $permission['actionList'] = [];
                $permission['dataAccess'] = null;
                $actionEntity = [];
                if (!empty($menu['children'])) {
                    foreach ($menu['children'] as $action) {
                        if ($action['type'] === 'action' && ($user->isSuper() || $user->can($action['id']))) {
                            $permission['actions'][] = ['action' => $action['name'], 'describe' => $action['title']];
                            $actionEntity[] = [
                                'action'       => $action['name'],
                                'describe'     => $action['title'],
                                'defaultCheck' => false,
                            ];
                            $permission['actionList'][] = $action['name'];
                        }
                    }
                    $permission['actionEntitySet'] = $actionEntity;
                } else {
                    $permission['actionList'][] = $menu['name'];
                    $permission['actions'][] = ['action' => $menu['name'], 'describe' => $menu['title']];
                    $permission['actionEntitySet'][] = [
                        'action'       => $menu['name'],
                        'describe'     => $menu['title'],
                        'defaultCheck' => false,
                    ];
                }

                // if (!empty($actionEntity)) {
                    $permissions[] = $permission;
                // }
            }

            if (!empty($menu['children'])) {
                $permissions = array_merge($permissions, $this->filterPermissionMenu($menu['children'], $user));
            }
        }

        return $permissions;
    }

    /**
     * 路由列表
     *
     * @param array $data
     *
     * @return array
     */
    protected function formatRoute($data)
    {
        $routes = [];
        foreach ($data as $item) {
            $route = [];
            $route['path'] = $item['path'];
            $route['name'] = $item['name'];
            $route['component'] = $item['component'];
            $route['meta']['title'] = $item['title'];

            $item['keepAlive'] === 1 && $route['meta']['keepAlive'] = true;
            $item['icon'] && $route['meta']['icon'] = $item['icon'];
            $item['permission'] && $route['meta']['permission'] = explode(',', $item['permission']);
            $item['redirect'] && $route['redirect'] = $item['redirect'];
            $item['hideChildrenInMenu'] === 1 && $route['hideChildrenInMenu'] = true;
            $item['hidden'] === 1 && $route['hidden'] = true;

            if (!empty($item['children'])) {
                $route['children'] = $this->formatRoute($item['children']);
            }
            $routes[] = $route;
        }

        return $routes;
    }

    /**
     * 格式化.
     *
     * @param array  $data
     * @param string $child_key
     * @param int    $pid
     * @param mixed  $id
     */
    public function formatTree($data, $id = 0)
    {
        $tree = [];
        foreach ($data as $item) {
            if ($item['pid'] == $id) {
                $item['value'] = (string) $item['id'];
                $item['title'] = $item['title'];
                $item['key']   = (string) $item['id'];

                $children = $this->formatTree($data, $item['id']);
                if (!empty($children)) {
                    $item['children'] = [];
                    $item['children'] = array_merge($item['children'], $this->formatTree($data, $item['id']));
                }
                $tree[] = $item;
            }
        }
        return $tree;
    }
}
