<?php
namespace App\Http\Requests;

class RoleCreateRequest extends BaseFromRequest
{
    public function rules()
    {
        return [
            'name'   => 'required|string|unique:roles',
            'title'  => 'required|string',
            'rules'  => 'array',
            'status' => 'required|integer'
        ];
    }
}
