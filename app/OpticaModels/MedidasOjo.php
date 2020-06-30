<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class MedidasOjo extends Model
{
    /**
     * Variable que indica la tabla que el modelo va mapear
     * 
     * @var string
     */
    protected $table = "medidas_ojo";
    /**
     * Variable que indica la primaryKey de la tabla
     * 
     * @var string
     */
    protected $primarykey = "id_medidas_ojo";
    /**
     * Variable para que Eloquent ignore los campos timestamps
     * 
     * @var bool
     */
    public $timestamps = false;
    /**
     * Variable para indicar los campos que nos son asignables en masa
     * 
     * @var array
     */
    protected $guarded = [];

    // Relaciones con otros modelos
    public function examenVisual()
    {
        return $this->belongsTo('App\OpticaModels\ExamenVisual', 'id_examen_visual', 'id_examen_visual');
    }
}
