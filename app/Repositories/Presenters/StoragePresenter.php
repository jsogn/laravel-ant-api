<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\StorageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StoragePresenter.
 *
 * @package namespace App\Repositories\Presenters;
 */
class StoragePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StorageTransformer();
    }
}
