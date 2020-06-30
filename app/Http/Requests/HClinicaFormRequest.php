<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\OpticaModels\HClinica;

class HClinicaFormRequest extends FormRequest
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
        // $hclinica = HClinica::find($this->historias_clinica);

        // if($this->isMethod('post'))
        // {
        //     $uniqueRule = "unique:App\OpticaModels\Paciente,cedula";
        // }
        // else
        // {
        //     $uniqueRule = "unique:App\OpticaModels\Paciente,cedula,$hclinica->id_paciente,id_paciente";
        // }

        return [
            'nombre' => ['bail', 'required', 'string'],
            'apellido' => ['bail', 'required', 'string'],
            'edad' => ['bail', 'numeric'],
            'cedula' => ['bail', 'string'], //$uniqueRule],
            'telefono' => ['bail', 'required', 'string'],
            'direccion' => ['bail', 'string'],
            'antecedentes' => ['bail', 'required', 'string']
        ];
    }
}
