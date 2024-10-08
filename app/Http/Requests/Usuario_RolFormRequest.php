<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Usuario_RolFormRequest extends FormRequest
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
            'id_usuario'=>'required|max:10',
            'id_rol'=>'required|max:10',
        ];
    }
}
