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
            'cod_minsa'=>'required|max:100',
            'nombre'=>'required|max:35',
            'apellido'=>'required|max:35',
            'cedula'=>'required|max:50',
            'telefono'=>'max:25',
            'correo'=>'required|max:50',
            'dir_foto'=>'max:255',
            'contraseña'=>'required|max:255',
            'descripcion'=>'max:500',
        ];
    }
}
