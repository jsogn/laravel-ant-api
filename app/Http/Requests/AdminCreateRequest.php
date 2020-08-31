<?php
namespace App\Http\Requests;

class AdminCreateRequest extends BaseFromRequest
{
    public function rules()
    {
        return [
            'account'  => 'required|string|max:10|unique:admins,account',
            'password' => 'required|min:8',
            'nickname' => 'required|string|max:15',
            'role_id'  => 'required|string',
            'status'   => 'required|integer'
        ];
    }
}
