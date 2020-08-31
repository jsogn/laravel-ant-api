<?php

namespace App\Http\Requests;

class PermissionFromRequest extends BaseFromRequest
{
    public function rules()
    {
        return [
            //权重
            'weight'             => 'integer',
            // 名称
            'name'               => 'required|string',
            // 标题
            'title'              => 'required|string',
            // 父ID
            'pid'                => 'required|integer',
            // 类型
            'type'               => 'required|string',
            // 状态
            'status'             => 'required|integer',
            // 路径
            'path'               => 'string',
            // 重定向
            'redirect'           => 'string',
            // 组件
            'component'          => 'string',
            // 图标
            'icon'               => 'string',
            // 权限标识
            'permission'         => 'array',
            // 路由缓存
            'keepAlive'          => 'integer',
            // 隐藏
            'hidden'             => 'integer',
            // 隐藏子菜单
            'hideChildrenInMenu' => 'integer',
            // 方法类型
            'action_type'        => 'required|integer',
            // 按钮类型
            'button_type'        => 'string'
        ];
    }
}
