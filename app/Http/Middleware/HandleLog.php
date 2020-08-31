<?php

namespace App\Http\Middleware;

use Closure;
use App\Events\HandleLogEvent;

class HandleLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, string $guard, string $action = '', string $except = '')
    {
        $response = $next($request);
        $excepts = explode('|', $except);

        if ($user = auth($guard)->user()) {
            $log = [
                'account'    => $user->account,
                'guard_name' => $user->guard_name,
                'action'     => $action,
                'method'     => $request->method(),
                'url'        => $request->path(),
                'ip'         => $request->ip(),
                'status'     => $response->status(),
                'agent'      => $request->userAgent(),
                'params'     => in_array('params', $excepts) ? null : json_encode($request->all() ?: []),
                'response'   => in_array('response', $excepts) ? null : ($response->content() ?: null),
            ];
            event(new HandleLogEvent($log));
        }
        return $response;
    }
}
