<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationFieldsException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ChildPersonalDataRequest extends FormRequest
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
            'name'               => 'bail|required|string|max:50',
            'id_card'            => 'bail|string|max:9',
            'health_care_number' => 'bail|string|max:20',
            'birthdate'          => 'string'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationFieldsException($validator);
    }
}
