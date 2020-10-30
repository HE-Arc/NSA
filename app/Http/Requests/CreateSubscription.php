<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreateSubscription extends Request
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
            //'association_id' => 'required|unique:subscriptions,user_id,association_id',
            'association_id' => 'required',
            'user_id' => 'required'
        ];
    }
}
