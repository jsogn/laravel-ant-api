<?php
namespace App\Http\Controllers\admin;

use App\Services\StorageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorageRequest;

class StorageController extends Controller
{
    private $storageService;

    public function __construct(StorageService $storageService)
    {
        $this->storageService = $storageService;

        $this->middleware('auth:admin');
    }

    public function image(StorageRequest $request)
    {
        $storage = $this->storageService->image($request);

        return $this->response->success(['path' => $storage->path, 'domain' => $request->root()]);
    }

    public function video()
    {

    }
}
