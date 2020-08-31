<?php
namespace App\Http\Requests;

class AdminUpdateRequest extends BaseFromRequest
{
    public function rules()
    {
        return [
            'account'  => 'filled|string|max:20',
            'password' => 'filled|min:8',
            'nickname' => 'filled|string|max:15',
            'role_id'  => 'filled|string',
            'status'   => 'filled|integer',
            'avatar'   => 'filled|string',
            'email'    => 'filled|email'
        ];
    }
}
