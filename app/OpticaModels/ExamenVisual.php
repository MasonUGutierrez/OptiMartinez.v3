<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class ExamenVisual extends Model
{
    /**
     * Variable para indicar la tabla que el modelo va mapear
     * 
     * @var string 
     */    
    protected $table = 'examen_visual';
    /**
     * Variable para indicar la primaryKey de la tabla
     * 
     * @var string
     */
    protected $primaryKey = 'id_examen_visual';
    /**
     * Variable para que Eloquent ignore los campos timestamps
     * 
     * @var bool
     */
    public $timestamps = false;
    /**
     * Variable para indicar los campos que no son asignables en masa
     * 
     * @var array
     */
    protected $guarded = [];

    // Relaciones con otros modelos
    public function consultaServicio(){
        return $this->belongsTo('App\OpticaModels\ConsultaServicio','id_consulta_servicio', 'id_consulta_servicio');
    }

    public function medidasOjos(){
        return $this->hasMany('App\OpticaModels\MedidasOjo','id_examen_visual','id_examen_visual');
    }
}
