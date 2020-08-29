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
            'nombres' => ['bail', 'required', 'string'],
            'apellidos' => ['bail', 'required', 'string'],
            // Nota: Estar atento si da error por regla date
            'fecha_nacimiento' => ['bail', 'required','date'], 
            'edad' => ['bail', 'numeric'],
            'sexo' => ['bail', 'string'],
            'cedula' => ['bail', 'nullable', 'string'], //$uniqueRule],
            'telefono' => ['bail', 'required', 'string'],
            'direccion' => ['bail', 'nullable', 'string'],
            'h_ocular' => ['bail', 'required', 'nullable','string'],
            'h_medica' => ['bail', 'nullable','string'],
            'medicaciones' => ['bail', 'nullable','string'],
            'alergias' => ['bail', 'nullable','string'],
        ];
    }
}
