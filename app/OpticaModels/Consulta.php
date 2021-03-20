<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    /**
     * Variable para indicar la tabla a mapear por el modelo
     *
     * @var string
     */
    protected $table = "consulta";

    /**
     * Variable para la llave primaria de la tabla
     *
     * @var string
     */
    protected $primaryKey = "id_consulta";

    /**
     * Variable para que Eloquent ignore los campos timestamps
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
    function historiaClinica()
    {
        return $this->belongsTo('App\OpticaModels\HClinica', 'id_historia_clinica', 'id_historia_clinica');
    }

    function jornadaTrabajo()
    {
        return $this->belongsTo('App\OpticaModels\JornadaTrabajo', 'id_jornada_trabajo', 'id_jornada_trabajo');
    }

    function consulta_servicios(){
        return $this->hasMany('App\OpticaModels\ConsultaServicio','id_consulta','id_consulta');
    }
    /*function servicios()
    {
        return $this->belongsToMany('App\Servicio', 'consulta-servicio', 'id_consulta', 'id_servicio')
                    ->using('App\OpticaModels\ConsultaServicio')
                    ->as('consultaServicio')
                    ->withPivot([
                        'precio',
                        'estado',
                        ]);
    }*/
}
