<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedidasOjoFormRequest extends FormRequest
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
            //
            /*'esfera'=>'bail|numeric',
            'cilindro'=>'bail|numeric',
            'eje'=>'bail|numeric',
            'adicion'=>'bail|numeric',
            'agudeza_visual'=>'bail|numeric',*/
        ];
    }
}
