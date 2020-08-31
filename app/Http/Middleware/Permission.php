<?php

namespace App\Http\Middleware;

use App\Support\Response;
use Closure;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, string $permission)
    {
        $user = $request->user();

        if (!$user->isSuper()) {
            $permissions = $user->role->permissions()->pluck('name')->toArray();
            if (!in_array($permission, $permissions)) {
                (new Response)->errorForbidden('权限不足，禁止访问！');
            }
        }

        return $next($request);
    }
}
