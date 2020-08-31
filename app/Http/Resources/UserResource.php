<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'account'  => $this->account,
            'nickname' => $this->nickname,
            'phone'    => $this->phone,
            'avatar'   => $this->avatar,
        ];
    }
}
