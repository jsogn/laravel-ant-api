<?php
namespace App\Services;

use App\Http\Requests\StorageRequest;
use App\Contracts\Repositories\StorageRepository;
use App\Repositories\Eloquent\StorageRepositoryEloquent;

class StorageService
{

    private $repository;

    /**
     * @param  StorageRepositoryEloquent  $repository
     */
    public function __construct(StorageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function image(StorageRequest $request)
    {
        $image = $request->file('image');

        return $this->repository->insertFileInfo($image, $image->store('images/' . $request->topic));
    }

    public function video()
    {

    }
}
