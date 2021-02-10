<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MaterialMica_MarcaMaterial extends Pivot
{
    /**
     * Variable para indicar la tabla que el modelo pivot va mapear
     * 
     * @var string
     */
    protected $table = 'material_mica-marca_material';
    /**
     * Variable para indicar la llave primaria de la tabla
     * 
     * @var string
     */
    protected $primaryKey = 'id_material_marca';
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
