<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoMaterialFormRequest extends FormRequest
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
        // Definiendo regla Unique
        if($this->isMethod('PUT'))
        {
            $uniqueRule="unique:App\OpticaModels\TipoMaterial,tipo_material,{$this->route('materiale')},id_tipo_material";
        }
        else
        {
            $uniqueRule="unique:App\OpticaModels\TipoMaterial,tipo_material";
        }

        return [
            'tipo_material' => ['bail', 'required', 'string', $uniqueRule],
            'precio' => ['bail', 'required', 'numeric']
        ];
    }
}
