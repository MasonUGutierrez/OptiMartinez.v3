<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class Filtro extends Model
{
    //
    /**
     * propiedad que indica la tabla que va mapear el modelo
     * 
     * @var string
     */
    protected $table="filtro";
    /**
     * propiedad que indica la primaryKey de la tabla
     * 
     * @var string
     */
    protected $primaryKey="id_filtro";
    /**
     * propiedad que indica que Eloquent ignore los campos timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;
    /**
     * propiedad que indica los campos que no estaran protegidos contra asignacion en masa
     * 
     * @var array
     */
    protected $guarded = [];

    /**
     * Relaciones con otros modelos
     */
    public function ordeneslente()
    {
        return $this->belongsToMany('App\OpticaModels\OrdenLente', 'filtro-orden_lente', 'id_filtro', 'id_orden_lente')
                    ->using('App\OpticaModels\Filtro_Orden')
                    ->as('filtroOrden')
                    ->withPivot([
                        'precio',
                        'estado'
                    ]);
    }
}
