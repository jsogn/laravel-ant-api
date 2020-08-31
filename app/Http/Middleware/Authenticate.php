<?php
namespace App\Http\Middleware;

use App\Support\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * 如果该用户未经过身份验证，将被重定向到此
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return (new Response())->errorUnauthorized('身份未授权或已失效');
        }
    }
}
