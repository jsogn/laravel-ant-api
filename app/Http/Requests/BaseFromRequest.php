<?php
namespace App\Http\Requests;

use App\Support\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

/**
 * 使用方法：
 * Class BaseFromRequest
 * @package App\Http\Requests
 */
class BaseFromRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function failedValidation($validator)
    {
        $errors = $validator->errors()->getMessages();

        throw new ValidationException($validator, (new Response)->fail('Validation error', 422, $errors));
    }
}
