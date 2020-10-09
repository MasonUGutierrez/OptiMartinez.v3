<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Mica_MarcaMica extends Pivot
{
    /**
     * Variable para indicar la tabla que el modelo pivot va mapear
     * 
     * @var string
     */
    protected $table = 'mica-marca_mica';
    /**
     * Variable para indicar la llave primaria de la tabla
     * 
     * @var string
     */
    protected $primaryKey = 'id_mica_marca';
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
     * Variable para indicar los campos que no seran asignables en masa
     * 
     * @var array
     */
    protected $guarded = [];
}
