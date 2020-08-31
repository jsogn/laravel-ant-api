<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'account'  => $this->account,
            'nickname' => $this->nickname,
            'avatar'   => $this->avatar,
        ];
    }
}
