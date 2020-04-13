<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class TipoMarco extends Model
{
    /**
     * Variable para indicar la tabla que mapea el modelo
     * 
     * @var string 
     */
    protected $table = 'tipo_marco';

    /**
     * Variable para indicar la llave primaria del modelo
     * 
     * @var int
     */
    protected $primaryKey = 'id_tipo_marco';

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

    // Relaciones con otros modelos
    /**
     * Metodo para indicar la relacion muchos a muchos con el modelo marco, ya que un tipo de marco pueden tener varios marcos que sean ese tipo
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function marcos()
    {
        return $this->belongsToMany('App\OpticaModels\Marco');
    }
}
