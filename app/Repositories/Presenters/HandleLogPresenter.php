<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\HandleLogTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * ClassHandleLogPresenter.
 *
 * @package namespace App\Repositories\Presenters;
 */
class HandleLogPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new HandleLogTransformer();
    }
}
