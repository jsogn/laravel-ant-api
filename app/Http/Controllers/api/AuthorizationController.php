<?php
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\Enums\ResponseCodeEnum;

class AuthorizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store']]);
    }

    public function destroy()
    {
        auth()->logout();

        return $this->response->noContent();
    }

    public function show()
    {
        $user = auth()->userOrFail();

        return $this->response->success(new UserResource($user));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'account'  => 'filled',
            'phone'    => 'required_without:account',
            'password' => 'required',
        ]);

        $credentials = request(['account', 'phone', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            $this->response->errorUnauthorized('授权失败');
        }

        $this->invalidateLastToken();
        $this->saveLastToken($token);

        return $this->respondWithToken($token);
    }

    public function update()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return $this->response->success(
            [
                'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => auth()->factory()->getTTL() * 60,
            ],
            '',
            ResponseCodeEnum::SERVICE_LOGIN_SUCCESS
        );
    }

    // 使上次token无效
    protected function invalidateLastToken() : void
    {
        $user = auth()->user();
        if ($user->last_token) {
            $lastToken = auth()->setToken($user->last_token);
            $lastToken->check() && $lastToken->invalidate();
        }
    }

    // 保存最近一次token
    protected function saveLastToken($token)
    {
        $user = auth()->user();
        $user->last_token = $token;

        return $user->save();
    }
}
