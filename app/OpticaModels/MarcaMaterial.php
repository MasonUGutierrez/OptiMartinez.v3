<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class MarcaMaterial extends Model
{
    /**
     * Variable para indicar la tabla que el modelo va mapear
     * 
     * @var string
     */
    protected $table = "marca_material";
    /**
     * Variable para indicar llave primaria de la tabla
     * 
     * @var string
     */
    protected $primaryKey = "id_marca_material";
    /**
     * Variable para indicar a Eloquente que ignore los campos timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;
    /**
     * Variable para indicar los campos que no seran asignables en masa
     * 
     * @var array
     */
    protected $guarded = [];

    /**
     * Relaciones con otros modelos
     */
    public function materiales() 
    {
        return $this->belongsToMany('App\OpticaModels\Material', 'material-marca_material', 'id_marca_material', 'id_material')
                    ->using('App\OpticaModels\Material_MarcaMaterial')
                    ->as('materialMarca')
                    ->withPivot([
                        'precio',
                        'estado'
                    ]);
    }
}
