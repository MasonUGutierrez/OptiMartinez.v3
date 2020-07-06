<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class Retinoscopia extends Model
{
    /**
     * Variable para indicar la tabla que el modelo va mapear
     * 
     * @var string
     */
    protected $table = 'retinoscopia';
    /**
     * Variable para primaryKey de la tabla
     * 
     * @var string
     */
    protected $primaryKey = 'id_retinoscopia';
    /**
     * Variable para que Eloquent ignore los campos timestamps
     * 
     * @var bool
     */
    public $timestamps = false;
    /**
     * Variable para indicar los campos o atributos que no son asignables en masa
     * 
     * @var array
     */
    protected $guarded = [];

    // Relaciones con otros modelos
    public function consultaServicio()
    {
        return $this->belongsTo('App\OpticaModels\ConsultaServicio', 'id_consulta_servicio', 'id_consulta_servicio');
    }
}