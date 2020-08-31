<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\Permission;

/**
 * Class PermissionTransformer.
 *
 * @package namespace App\Repositories\Transformers;
 */
class PermissionTransformer extends TransformerAbstract
{
    /**
     * Transform the Permission entity.
     *
     * @param \App\Repositories\Models\Permission $model
     *
     * @return array
     */
    public function transform(Permission $model)
    {
        return [
            'id'         => (int) $model->id,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
