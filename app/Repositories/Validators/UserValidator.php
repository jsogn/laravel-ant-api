<?php
namespace App\Repositories\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'account'  => 'required|string|max:10',
            'phone'    => 'required|integer|size:11|unique:users',
            'password' => 'required|min:8',
        ],

        ValidatorInterface::RULE_UPDATE => [
            'password' => 'required|min:8',
        ],
    ];
}
