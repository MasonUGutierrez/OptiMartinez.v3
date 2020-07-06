<?php

namespace App\OpticaModels;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use phpDocumentor\Reflection\Types\Self_;

class ConsultaServicio extends Pivot
{
    /**
     * Variable para indicar la tabla que el modelo va mapear
     * 
     * @var string
     */
    protected $table = "consulta-servicio";
    
    /**
     * Variable para indicar la primaryKey de la tabla
     * 
     * @var string
     */
    protected $primaryKey = "id_consulta_servicio";
    
    /**
     * Variable para que Eloquent ignore los campos timestamps
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Variable que indica que tiene una primaryKey auto-incrementable
     * 
     * @var bool
     */    
    public $incrementing = true;
    /**
     * Variable para indicar los campos que no son asignables en masa
     * 
     * @var array
     */
    protected $guarded = [];

    // Relaciones con otros modelos como tabla intermedia
    public function consulta()
    {
        return $this->belongsTo('App\OpticaModels\Consulta', 'id_consulta', 'id_consulta');        
    }
    public function servicio()
    {
        return $this->belongsTo('App\Servicio', 'id_servicio', 'id_servicio');
    }

    // Relaciones con otros modelos
    public function examenVisual()
    {
        return $this->hasOne('App\OpticaModels\ExamenVisual', 'id_consulta_servicio', 'id_consulta_servicio');
    }

    public function retinoscopia()
    {
        return $this->hasOne('App\OpticaModels\Retinoscopia', 'id_consulta_servicio', 'id_consulta_servicio');
    }
}
