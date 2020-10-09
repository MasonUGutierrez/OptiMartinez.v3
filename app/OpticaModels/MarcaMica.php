<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class MarcaMica extends Model
{
    /**
     * Variable para indicar la tabla que el modelo va mapear
     * 
     * @var string
     */
    protected $table = "marca_mica";
    /**
     * Variable para indicar llave primaria de la tabla
     * 
     * @var string
     */
    protected $primaryKey = "id_marca_mica";
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
    public function micas() 
    {
        return $this->belongsToMany('App\OpticaModels\Mica', 'mica-marca_mica', 'id_marca_mica', 'id_mica')
                    ->using('App\OpticaModels\Mica_MarcaMica')
                    ->as('micaMarca')
                    ->withPivot([
                        'precio',
                        'estado'
                    ]);
    }
}
