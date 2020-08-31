<?php
namespace App\Support\Helper;

class PermissionHelper
{
    //原始的分类数据
    private $rawList = [];

    //格式化后的分类
    private $formatList = [];

    //格式化的字符
    private $icon = ['│', '├', '└'];

    //字段映射，分类id，上级分类pid,分类名称title,格式化后分类名称fulltitle
    private $field = [];

    public function __construct($field = [])
    {
        $this->field['id'] = isset($field['0']) ? $field['0'] : 'id';
        $this->field['pid'] = isset($field['1']) ? $field['1'] : 'pid';
        $this->field['title'] = isset($field['2']) ? $field['2'] : 'title';
        $this->field['fulltitle'] = isset($field['3']) ? $field['3'] : 'fulltitle';
    }

    public function getChildTree($data)
    {
        $tree = [];
        $field = $this->field;
        foreach ($data as $item) {
            $children = $this->getChild($item[$field['id']], $data);
            if (!empty($chilren)) {
                $this->getChildTree($children);
                $item['children'] = $children;
            }

            $tree[] = $item;
        }

        return $tree;
    }

    public function getChild($pid, $data = [])
    {
        $childs = [];
        if (empty($data)) {
            $data = $this->rawList;
        }
        foreach ($data as $Category) {
            if ($Category[$this->field['pid']] == $pid) {
                $childs[] = $Category;
            }
        }

        return $childs;
    }

    public function getTree($data, $id = 0)
    {
        //数据为空，则返回
        if (empty($data)) {
            return false;
        }

        $this->rawList = [];
        $this->formatList = [];
        $this->rawList = $data;
        $this->_searchList($id);

        return $this->formatList;
    }

    //获取当前分类的路径
    public function getPath($data, $id)
    {
        $this->rawList = $data;
        while (1) {
            $id = $this->_getPid($id);
            if ($id == 0) {
                break;
            }
        }

        return array_reverse($this->formatList);
    }

    /**
     * 格式化.
     *
     * @param array  $data
     * @param string $child_key
     * @param int    $pid
     * @param mixed  $id
     */
    public function formatTree($data, $child_key = 'children', $id = 0)
    {
        $tree = [];
        $field = $this->field;
        foreach ($data as $item) {
            if ($item[$field['pid']] == $id) {
                $item['value'] = (string) $item[$field['id']];
                $item['title'] = $item[$field['title']];
                $item['key'] = (string) $item[$field['id']];

                $children = $this->formatTree($data, $child_key, $item[$field['id']]);
                if (!empty($children)) {
                    $item[$child_key] = [];
                    $item[$child_key] = array_merge($item[$child_key], $this->formatTree($data, $child_key, $item[$field['id']]));
                }

                $tree[] = $item;
            }
        }

        return $tree;
    }

    /**
     * 过滤用户可操作按钮跟查看权限.
     *
     * @param array $data
     * @param User  $user
     */
    public function filterPermissionMenu($data, $user)
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
                        // if ($action['type'] === 'action' && $user->can($action['name'])) {
                        if ($action['type'] === 'action') {
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
    public function formatRoute($data)
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


    private function _searchList($id = 0, $space = '')
    {
        //下级分类的数组
        $childs = $this->getChild($id);
        //如果没下级分类，结束递归
        if (!($n = count($childs))) {
            return;
        }
        $cnt = 1;
        //循环所有的下级分类
        for ($i = 0; $i < $n; $i++) {
            $pre = '';
            $pad = '';
            if ($n == $cnt) {
                $pre = $this->icon[2];
            } else {
                $pre = $this->icon[1];
                $pad = $space ? $this->icon[0] : '';
            }
            $childs[$i][$this->field['fulltitle']] = ($space ? $space . $pre : '') . $childs[$i][$this->field['title']];
            $this->formatList[] = $childs[$i];
            //递归下一级分类
            $this->_searchList($childs[$i][$this->field['id']], $space . $pad . '&nbsp;&nbsp;');
            $cnt++;
        }
    }

    //通过当前id获取pid
    private function _getPid($id)
    {
        foreach ($this->rawList as $key => $value) {
            if ($id == $this->rawList[$key][$this->field['id']]) {
                $this->formatList[] = $this->rawList[$key];

                return $this->rawList[$key][$this->field['pid']];
            }
        }

        return 0;
    }
}
