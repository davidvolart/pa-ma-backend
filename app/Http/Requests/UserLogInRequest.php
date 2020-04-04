<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationFieldsException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserLogInRequest extends FormRequest
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
            'email'       => 'bail|required|string|email',
            'password'    => 'bail|required|string',
            'remember_me' => 'string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationFieldsException($validator);
    }
}
