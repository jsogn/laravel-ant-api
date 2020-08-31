<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 用户授权
Route::post('authorization', 'AuthorizationController@store');
Route::delete('authorization', 'AuthorizationController@destroy');
Route::put('authorization', 'AuthorizationController@update');
Route::get('authorization', 'AuthorizationController@show');

// 用户信息
Route::post('user', 'UserController@store');
