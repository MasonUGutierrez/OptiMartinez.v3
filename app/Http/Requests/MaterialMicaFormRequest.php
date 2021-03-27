<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialMicaFormRequest extends FormRequest
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
            $uniqueRule="unique:App\OpticaModels\MaterialMica,material_mica,{$this->route('materiale')},id_material_mica";
        }
        else
        {
            $uniqueRule="unique:App\OpticaModels\MaterialMica,material_mica";
        }

        return [
            'material_mica' => ['bail', 'required', 'string', $uniqueRule]
        ];
    }
}
