<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamenVisualFormRequest extends FormRequest
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
           /* 'distancia_pupilar'=>'bail|numeric',
            'alt'=>'bail|numeric',
            'observacion'=>'bail|min:3|max:255',*/
        ];
    }
}
