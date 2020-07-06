<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class JornadaTrabajo extends Model
{
    /**
     * Variable para indicar la tabla que el modelo va mapear
     * 
     * @var string
     */
    protected $table = 'jornada_trabajo';
    /**
     * Variable para indicar la primaryKey de la tabla
     * 
     * @var string
     */
    protected $primaryKey = 'id_jornada_trabajo';
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
    public function jornada()
    {
        return $this->belongsTo('App\OpticaModels\Jornada', 'id_jornada', 'id_jornada');
    }

    public function departamento()
    {
        return $this->belongsTo('App\OpticaModels\Departamento', 'id_departamento', 'id_departamento');
    }
}