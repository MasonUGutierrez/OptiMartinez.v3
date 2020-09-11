<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcoFormRequest extends FormRequest
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
        if($this->isMethod('PUT'))
        {
            $uniqueRule = "unique:App\OpticaModels\Marco,cod_marco,{$this->route('marco')},id_marco";                        
        }
        else
        {
            $uniqueRule = "unique:App\OpticaModels\Marco,cod_marco";                    
        }
        return [
            'id_marca' => ['bail', 'required', 'numeric'],
            'cod_marco' => ['bail', 'required', 'string', $uniqueRule],
            // Agregue codigo para validar cuando no sube fotos al actualizar
            // Version 1
            'dir_foto' => ['bail', ($this->isMethod('POST'))?'required':'', ($this->isMethod('PUT') && empty($this->get('dir_foto')))?'':'mimes:jpeg,png,svg,webp'],
            'precio' => ['bail', 'required', 'numeric'],
            'c_existencia' => ['bail', 'required', 'numeric']
        ];
    }
}
