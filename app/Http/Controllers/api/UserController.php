<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        $this->middleware('auth:api', ['except' => ['store', 'show', 'index']]);
    }

    // 获取用户列表
    public function index(Request $request)
    {
        $users = $this->userService->list($request);

        return $this->response->success($users);
    }

    // 显示用户
    public function show($id)
    {
        $user = $this->userService->profile($id);

        return $this->response->success($user);
    }

    // 保存用户
    public function store(Request $request)
    {
        $this->validate($request, [
            'account'  => 'required|string|min:5|max:15|unique:users,account|alpha_dash',
            'phone'    => 'required|mobile|unique:users,phone',
            'password' => 'required|min:8',
        ]);

        $user = $this->userService->registration($request);

        return $this->response->created(new UserResource($user));
    }
}
