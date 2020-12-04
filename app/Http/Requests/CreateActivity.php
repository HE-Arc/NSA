<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateActivity extends FormRequest
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
            'association_id' => 'required',
            'title'          => 'required|string|min:2|max:150',
            'description'    => 'required|string|min:2|max:5000',
            'date'           => 'required|date|after_or_equal:today',
            'location'       => 'required',
            'image'          => 'image|nullable|mimes:png,jpg,jpeg,gif|max:10240', // required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000
        ];
    }
}
