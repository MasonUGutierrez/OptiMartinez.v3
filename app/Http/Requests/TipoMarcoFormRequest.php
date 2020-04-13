<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoMarcoFormRequest extends FormRequest
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
            $reglaUnique = "unique:App\OpticaModels\TipoMarco,tipo_marco,{$this->route('tipos-marcos')},id_tipo_marco";
        else
            $reglaUnique = "unique:App\OpticaModels\TipoMarco,tipo_marco";

        return [
            'tipo_marco' => ['bail', 'required', 'string', $reglaUnique],
        ];
    }
}
