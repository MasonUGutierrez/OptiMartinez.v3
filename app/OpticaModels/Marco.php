<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class Marco extends Model
{
    /**
     * Variable para indicar la tabla que mapea el modelo
     * 
     * @var string
     */
    protected $table = 'marco';

    /**
     * Variable para indicar la llave primaria del modelo
     * 
     * @var int
     */
    protected $primaryKey = 'id_marco';

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
     * Metodo que indica la relacion inversa de uno a muchos, ya que un marco solo le pertenece a una marca
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function marca()
    {
        return $this->belongsTo('App\OpticaModels\Marca', 'id_marca', 'id_marca');
    }

    /**
     * Metodo que indica la relacion muchos a muchos, ya que un marco puede ser de varios tipos de marcos
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function tiposmarcos()
    {
        return $this->belongsToMany('App\OpticaModels\TipoMarco', 'marco-tipo_marco', 'id_marco', 'id_tipo_marco') 
                ->withPivot('id_mtm');
    }
}
