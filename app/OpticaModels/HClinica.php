<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class HClinica extends Model
{
    /**
     * Variable para indicar la tabla que mapea el modelo
     * 
     * @var string
     */
    protected $table = 'historia_clinica';

    /**
     * Variable para la llave primaria de la tabla
     * 
     * @var string
     */
    protected $primaryKey = 'id_historia_clinica';

    /**
     * Variable para que Eloquent ignores los campos timestamp
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Variable para indicar los campos o atributos que no son asignables en masa
     * 
     * @var array
     */
    protected $guarded = [];

    /* Relaciones con otros modelos */

    public function paciente()
    {
        return $this->belongsTo('App\OpticaModels\Paciente', 'id_paciente', 'id_paciente');
    }
    public function consultas()
    {
        return $this->hasMany('App\OpticaModels\Consulta','id_historia_clinica', 'id_historia_clinica');
    }
}
