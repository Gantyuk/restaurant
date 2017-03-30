<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRestaurant extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date'=>'required',
            'name'=>'required|min:2',
            'category'=>'required',
            'short_description'=>'required|min:5',
            'description'=>'required|min:15',
            'image'=>'required',
            'menu'=>'required',
            'address'=>'required'
        ];
    }
}
