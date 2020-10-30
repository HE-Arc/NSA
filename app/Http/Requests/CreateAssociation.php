<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAssociation extends FormRequest
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
     * The uniqueness of the name and the email are handled with the Rule::unique method,
     * so that the Association can be edited and keep its own name and/or email.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('associations', 'name')->ignore($this->association),
                'max:255'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('associations', 'email')->ignore($this->association)
            ]
        ];
    }
}
