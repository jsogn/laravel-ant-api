<?php

namespace App\Http\Controllers;

use App\Repositories\Enums\ExampleEnum;
use App\Repositories\Models\Log;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // $this->middleware('enum:false');
    }

    // 获取系统配置信息
    public function configurations(Request $request)
    {
        return $this->response->success([
            'app'          => config('app'),
            'auth'         => config('auth'),
            'broadcasting' => config('broadcasting'),
            'cache'        => config('cache'),
            'database'     => config('database'),
            'filesystems'  => config('filesystems'),
            'logging'      => config('logging'),
            'queue'        => config('queue'),
            'services'     => config('services'),
        ]);
    }

    public function logs()
    {
        return $this->response->success(Log::all());
    }

    public function enums(Request $request)
    {
        if ($request->has('user_type') && $request->input('user_type') instanceof ExampleEnum) {
            return $this->response->success($request->input('user_type'));
        }

        $this->response->fail('transform enum fail');
    }
}
