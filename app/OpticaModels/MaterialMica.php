<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class MaterialMica extends Model
{
    /**
     * Variable para indicar la tabla que mapea el modelo
     * 
     * @var string
     */
    protected $table = 'material_mica';

    /**
     * Variable para indicar la llave primaria del modelo
     * 
     * @var int
     */
    protected $primaryKey = 'id_material_mica';

    /**
     * Variable para que Eloquent ignore el timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Variable para indicar los atributos o campos que no son asignables en masa de la tabla
     * 
     * @var array
     */
    protected $guarded = [];

    /**
     * Relaciones con otros modelos
     */
    public function marcasmaterial()
    {
        return $this->belongsToMany('App\OpticaModels\MarcaMaterial');
    }
}
