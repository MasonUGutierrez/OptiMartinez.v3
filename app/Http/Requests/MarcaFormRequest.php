<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MarcaFormRequest extends FormRequest
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
            $reglaMarca = 'unique:App\OpticaModels\Marca,marca,'.$this->id_marca.',id_marca';
            $reglaUniqueImg = 'unique:App\OpticaModels\Marca,img'.$this->id_marca.',id_marca';
        }
        else
        {
            $reglaMarca = 'unique:App\OpticaModels\Marca,marca';
            $reglaUniqueImg = 'unique:App\OpticaModels\Marca,img';
        }   
        // La regla unique tiene que cumplir la sintaxis= unique:table,column,except,idColumn
        // ($this->isMethod('post')) ? 'unique:App\OpticaModels\Marca' : ''
        return [
            'marca' => ['bail', 'required', 'string', $reglaMarca],
            'img.*' => ['bail', ($this->isMethod('post')) ? 'required' : '' , $reglaUniqueImg, 'mimes:jpg,jpeg,png'],
            'precio' => ['bail', 'required', 'numeric']
        ];
    }

}
