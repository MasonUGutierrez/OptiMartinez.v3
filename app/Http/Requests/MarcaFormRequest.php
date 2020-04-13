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
            // route('param') retorna el parametro que se esta enviando por la URL, en este caso marca, porque asi establece la ruta
            $reglaMarca = "unique:App\OpticaModels\Marca,marca,{$this->route('marca')},id_marca";
        }
        else
            $reglaMarca = 'unique:App\OpticaModels\Marca,marca';

            // La regla unique tiene que cumplir la sintaxis= unique:table,column,except,idColumn
        // ($this->isMethod('post')) ? 'unique:App\OpticaModels\Marca' : ''
        return [
            'marca' => ['bail', 'required', 'string', $reglaMarca],
            'img' => ['bail', ($this->isMethod('post')) ? 'required' : '', 'mimes:jpeg,png'],
            'precio' => ['bail', 'required', 'numeric']
        ];
    }

}
