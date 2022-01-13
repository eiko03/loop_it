<?php

namespace Modules\Authentication\requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'email'=>'required|email|max:30',
            'password'=>'required|max:30|min:8|regex:/^.*(?=[^a-z]*[a-z])(?=[^A-Z]*[A-Z])(?=\D*\d).{8,}.*$/',
        ];
    }
}
