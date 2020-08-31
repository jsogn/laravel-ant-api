<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\Enums\ResponseCodeEnum;

class AuthorizationController extends Controller
{
    private $auth = null;

    public function __construct()
    {
        $this->auth = auth('admin');
        $this->middleware('auth:admin', ['except' => ['store']]);
    }

    public function destroy()
    {
        $this->auth->logout();

        return $this->response->noContent();
    }

    public function show()
    {
        $user = $this->auth->userOrFail();

        return $this->response->success(new UserResource($user));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'account'  => 'required',
            'password' => 'required',
        ]);

        $credentials = request(['account', 'password']);

        if (!$token = $this->auth->attempt($credentials)) {
            $this->response->errorUnauthorized('授权失败');
        }

        $this->invalidateLastToken();
        $this->saveLastToken($token);

        return $this->respondWithToken($token);
    }

    public function update()
    {
        return $this->respondWithToken($this->auth->refresh());
    }

    protected function respondWithToken($token)
    {
        return $this->response->success(
            [
                'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => $this->auth->factory()->getTTL() * 60,
            ],
            '',
            ResponseCodeEnum::SERVICE_LOGIN_SUCCESS
        );
    }

    protected function invalidateLastToken() : void
    {
        try {
            $user = $this->auth->user();
            $lastToken = $this->auth->setToken($user->last_token);
            $lastToken->invalidate();
        } catch (\Throwable $th) {}
    }

    protected function saveLastToken($token)
    {
        $user = $this->auth->user();
        $user->last_token = $token;

        return $user->save();
    }
}
