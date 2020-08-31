<?php

namespace App\Http\Requests;

class RoleUpdateRequest extends BaseFromRequest
{
    public function rules()
    {
        return [
            'name'   => 'required|string',
            'title'  => 'required|string',
            'rules'  => 'array',
            'status' => 'required|integer'
        ];
    }
}
