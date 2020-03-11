<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Validation\Validator;

class AuthValidationFieldsException extends Exception
{
    protected $validator;
    protected $code = Response::HTTP_UNPROCESSABLE_ENTITY;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function render()
    {
        return response()->json(['message' => $this->validator->errors()->first()], $this->code);
    }
}
