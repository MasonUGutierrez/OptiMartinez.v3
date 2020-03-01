<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioFormRequest extends FormRequest
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
            'cod_minsa'=>'required|max:100|min:3',
            'nombre'=>'required|max:35|min:3|regex:/^[a-zA-Z ]+$/',
            'apellido'=>'required|max:35|min:3|string',
            'cedula'=>'required|max:50|regex:[\d{3}\d{6}\d{4}[a-zA-Z]{1}]',
            'telefono'=>'numeric|digits:8|nullable',
            'correo'=>'required|max:50',
            'dir_foto'/*=>'mimes:jpg,bmp,png','max:255'*/,
            'contraseña'=>'required|max:255',
            'descripcion'=>'max:500',
        ];
    }
}
