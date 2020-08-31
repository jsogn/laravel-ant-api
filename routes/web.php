<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('configurations', 'ExampleController@configurations');

Route::post('users', 'UsersController@store');
Route::get('users/{id}', 'UsersController@show');
Route::get('users', 'UsersController@index');

Route::post('authorization', 'AuthorizationController@store');
Route::delete('authorization', 'AuthorizationController@destroy');
Route::put('authorization', 'AuthorizationController@update');
Route::get('authorization', 'AuthorizationController@show');
