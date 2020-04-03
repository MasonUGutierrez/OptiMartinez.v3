<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        // La regla unique tiene que cumplir la sintaxis= unique:table,column,except,idColumn
        return [
            'marca' => ['bail', 'required', 'string', ($this->isMethod('post')) ? 'unique:App\OpticaModels\Marca' : ''],
            'img.*' => ['bail', ($this->isMethod('post')) ? 'required' : '' , 'mimes:jpg,jpeg,png'],
            'precio' => ['bail', 'required', 'numeric']
        ];
    }
}
