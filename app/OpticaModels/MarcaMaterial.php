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
    protected $table = "marca_material_mica";
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
    public function materialesmica() 
    {
        return $this->belongsToMany('App\OpticaModels\MaterialMica', 'material_mica-marca_material', 'id_marca_material', 'id_material_mica')
                    ->using('App\OpticaModels\MaterialMica_MarcaMaterial')
                    ->as('micaMarca')
                    ->withPivot([
                        'precio',
                        'estado'
                    ]);
    }
}
