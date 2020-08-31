<?php
namespace App\Repositories\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class AdminValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'account'  => 'required|string|max:10',
            'password' => 'required|min:8',
        ],

        ValidatorInterface::RULE_UPDATE => [
            'password' => 'filled|min:8',
        ],
    ];
}
