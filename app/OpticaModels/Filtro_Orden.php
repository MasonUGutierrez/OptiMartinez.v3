<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Filtro_Orden extends Pivot
{
    /**
     * Variable para indicar la tabla que el modelo va mapear
     * 
     * @var string
     */
    protected $table = 'filtro-orden';
    /**
     * Variable para indicar la llave primaria de la tabla
     * 
     * @var string
     */
    protected $primaryKey = 'id_filtro_orden';
    /**
     * Variable para indicar que Eloquent ignore los campos timestamps
     * 
     * @var boolean
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
}
