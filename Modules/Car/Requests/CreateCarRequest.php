<?php

namespace Modules\Car\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCarRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'model'=>'required|string',
            'brand'=>'required|string',
        ];
    }
}
