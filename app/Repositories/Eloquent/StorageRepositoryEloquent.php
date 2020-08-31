<?php

namespace App\Repositories\Eloquent;

use Illuminate\Http\UploadedFile;
use App\Repositories\Models\Storage;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\StorageRepository;
use App\Repositories\Validators\StorageValidator;

/**
 * Class StorageRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class StorageRepositoryEloquent extends BaseRepository implements StorageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Storage::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StorageValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function insertFileInfo(UploadedFile $file, string $path) : Storage
    {
        $this->model->driver        = 'local';
        $this->model->original_name = $file->getClientOriginalName();
        $this->model->path          = $path;
        $this->model->type          = $file->getMimeType();
        $this->model->size          = $file->getSize();
        $this->model->ext           = $file->extension();
        $this->model->author        = auth()->user()->account;
        $this->model->save();

        return $this->model;
    }



}
