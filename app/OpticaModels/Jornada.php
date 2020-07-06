<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    /**
     * Variables para indicar la tabla que el model va mapear
     * 
     * @var string
     */
    protected $table = 'jornada';
    /**
     * Variables para indicar la primaryKey de la tabla
     * 
     * @var string
     */
    protected $primaryKey = 'id_jornada';
    /**
     * Variables para que Eloquent ignore los campos timestamps
     * 
     * @var bool
     */
    public $timestamps = false;
    /**
     * Variables para indicar los campos o atributos que no son asignables en masa
     * 
     * @var array
     */
    protected $guarded = [];

    // Relaciones con otros modelos
    public function jornadasTrabajos()
    {
        return $this->hasMany('App\OpticaModels\JornadaTrabajo', 'id_jornada', 'id_jornada');
    }
}

