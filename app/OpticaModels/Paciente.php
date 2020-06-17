<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasOne;

class Paciente extends Model
{
    /**
     * Variable para indicar la tabla que mapea el modelo
     * 
     * @var string 
     */
    protected $table = 'paciente';

    /**
     * Variable para la llave primaria de la tabla
     * 
     * @var string
     */
    protected $primaryKey = 'id_paciente';

    /**
     * Variable para que Eloquent ignore los campos timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Variable para indicar los atributos o campos que no son asginables en masa en la tabla
     * 
     * @var array
     */

    protected $guarded=[];

    /* Relaciones con otro modelos */

    public function hclinica()
    {
        return $this->hasOne('App\OpticaModels\HClinica', 'id_paciente', 'id_paciente');
    }

    public function hcuenta()
    {
        return $this->hasOne('App\OpticaModels\HCuenta', 'id_paciente', 'id_paciente');
    }
}