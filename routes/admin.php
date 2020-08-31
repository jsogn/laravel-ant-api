<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 授权
Route::post('authorization', 'AuthorizationController@store')->middleware(['HandleLog:admin,系统登录,params|response']);
Route::delete('authorization', 'AuthorizationController@destroy')->middleware(['HandleLog:admin,退出登录']);

// Route::put('authorization', 'AuthorizationController@update');
// Route::get('authorization', 'AuthorizationController@show');

// 后台用户
Route::post('user', 'AdminController@store')->middleware(['permission:addAdmin', 'HandleLog:admin,添加管理员,params|response']);
Route::get('user', 'AdminController@show');
Route::put('user', 'AdminController@modify');
Route::get('user/list', 'AdminController@list')->middleware(['permission:queryAdmin']);
Route::put('user/{id}', 'AdminController@update')->middleware(['permission:editAdmin']);
Route::delete('user/{id}', 'AdminController@destroy')->middleware(['permission:deleteAdmin', 'HandleLog:admin,删除管理员']);

// 权限规则
Route::post('permission', 'PermissionController@store')->middleware(['permission:addPermission', 'HandleLog:admin,添加权限']);
Route::delete('permission/{id}', 'PermissionController@destroy')->middleware(['permission:deletePermission', 'HandleLog:admin,删除权限']);
Route::put('permission/{id}', 'PermissionController@update')->middleware(['permission:editPermission', 'HandleLog:admin,更新权限']);
Route::get('permission', 'PermissionController@list')->middleware(['permission:queryPermission']);

//角色管理
Route::get('role', 'roleController@list')->middleware(['permission:queryRole']);
Route::post('role', 'roleController@store')->middleware(['permission:addRole', 'HandleLog:admin,添加角色']);
Route::put('role/{id}', 'roleController@update')->middleware(['permission:editRole', 'HandleLog:admin,更新角色']);
Route::delete('role/{id}', 'roleController@destroy')->middleware(['permission:deleteRole', 'HandleLog:admin,删除角色']);

// 操作日志管理
Route::get('handle/log', 'handleLogController@list')->middleware(['permission:queryHandleLog']);

// 图片上传
Route::post('storage/image', 'storageController@image')->middleware(['HandleLog:admin,上传图片']);
