<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    /**
     * Variable para indicar la tabla que mapea el modelo
     * 
     * @var string
     */
    protected $table = 'marca';

    /**
     * Variable para indicar la llave primaria del modelo
     * 
     * @var int
     */
    protected $primaryKey = 'id_marca';

    /**
     * Variable para que Eloquent ignore el timestamps
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

    /**
     * Metodo que define la relacion de uno a muchos con los marcos, ya que una marca contiene muchos marcos
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function marcos()
    {
        return $this->hasMany('App\OpticaModels\Marco', 'id_marca', 'id_marca');
    }
}
