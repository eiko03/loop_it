<?php

namespace Modules\Car\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarIndexRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'count_per_page'=>'sometimes|numeric',
            'sort'=>'required_with:sort_by|string',
            'sort_by'=>'required_with:sort|string',
            'search'=>'sometimes|string',
        ];
    }
}
