<?php

namespace Modules\Authentication\requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'email'=>'required|email|max:30|unique:users',
            'name'=>'required|max:30',
            'password'=>'required|confirmed|min:8|regex:/^.*(?=[^a-z]*[a-z])(?=[^A-Z]*[A-Z])(?=\D*\d).{8,}.*$/',
        ];
    }
}
