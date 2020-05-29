<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoLenteFormRequest extends FormRequest
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
            $uniqueRule = "unique:App\OpticaModels\TipoLente,tipo_lente,{$this->route('tipos_lente')},id_tipo_lente";        
        else 
            $uniqueRule = "unique:App\OpticaModels\TipoLente,tipo_lente";
        return [
            'tipo_lente'=>['bail', 'required', 'string', $uniqueRule],
            'precio'=>['bail', 'required', 'numeric']
        ];
    }
}
