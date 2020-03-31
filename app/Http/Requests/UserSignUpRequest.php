<?php

namespace App\Http\Requests;

use App\Exceptions\AuthValidationFieldsException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class UserSignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'bail|required|string',
            'email'         => 'bail|required|string|email|unique:users',
            'password'      => 'bail|required|string|confirmed',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new AuthValidationFieldsException($validator);
    }
}
