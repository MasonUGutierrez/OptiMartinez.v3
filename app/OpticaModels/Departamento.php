<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    /**
     * Variable para indicar la tabla que el modelo va mapear
     * 
     * @var string
     */
    protected $table = 'departamento';
    /**
     * Variable para indicar la primaryKey de la tabla
     * 
     * @var string
     */
    protected $primaryKey = 'id_departamento';
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

    // Relaciones con otro modelos
    public function jornadasTrabajos()
    {
        return $this->hasMany('App\OpticaModels\JornadaTrabajo', 'id_departamento', 'id_departamento');
    }
}