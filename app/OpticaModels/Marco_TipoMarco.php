<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class Marco_TipoMarco extends Model
{
    /**
     * Variable para indicar la tabla que mapea el modelo
     * 
     * @var string
     */
    protected $table = "marco-tipo_marco";

    /**
     * Variable para la llave primaria de la tabla
     * 
     * @var string
     */
    protected $primaryKey = "id_mtm";

    /**
     * Variable para que Eloquent ignore los campos timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Variable para indicar los atributos o campos que no son asignables en masa en la tabla
     * 
     * @var array
     */
    protected $guarded = [];

    // Relaciones con otros modelos
}
