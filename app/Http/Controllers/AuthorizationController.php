<?php
namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Repositories\Enums\ResponseCodeEnum;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    /**
     * Create a new AuthController instance.
     */
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
            'account'  => 'filled|account',
            'phone'    => 'required_without:account',
            'password' => 'required',
        ]);

        $credentials = request(['name', 'phone', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            $this->response->errorUnauthorized();
        }

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
}
