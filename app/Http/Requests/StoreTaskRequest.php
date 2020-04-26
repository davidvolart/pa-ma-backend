<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationFieldsException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'name'        => 'bail|required|string|max:255',
            'date'        => 'bail|required|date',
            'assigne_me'  => 'bail|required|string',
            'description' => 'bail|string|max:255',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationFieldsException($validator);
    }
}
