<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\HandleLog;

/**
 * ClassHandleLogTransformer.
 *
 * @package namespace App\Repositories\Transformers;
 */
class HandleLogTransformer extends TransformerAbstract
{
    /**
     * Transform theHandleLog entity.
     *
     * @param \App\Repositories\Models\HandleLog $model
     *
     * @return array
     */
    public function transform(HandleLog $model)
    {
        return [
            'id'         => (int) $model->id,
            /* place your other model properties here */
            'guard_name' => $model->guard_name,
            'account'    => $model->account,
            'action'     => $model->action,
            'method'     => $model->method,
            'url'        => $model->url,
            'ip'         => $model->ip,
            'params'     => $model->params,
            'agent'      => $model->agent,
            'response'   => $model->response,
            'status'     => $model->status,
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $model->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
