<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Services\HandleLogService;
use App\Http\Controllers\Controller;

class HandleLogController extends Controller
{
    private $handleLogService;

    public function __construct(HandleLogService $handleLogService)
    {
        $this->handleLogService = $handleLogService;
        $this->middleware('auth:admin');
    }

    public function list(Request $request)
    {
        return $this->response->success($this->handleLogService->list($request));
    }

}
