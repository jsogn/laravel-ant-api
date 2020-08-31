<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\Storage;

/**
 * Class StorageTransformer.
 *
 * @package namespace App\Repositories\Transformers;
 */
class StorageTransformer extends TransformerAbstract
{
    /**
     * Transform the Storage entity.
     *
     * @param \App\Repositories\Models\Storage $model
     *
     * @return array
     */
    public function transform(Storage $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
