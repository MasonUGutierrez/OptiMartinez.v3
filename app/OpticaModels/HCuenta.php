<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class HCuenta extends Model
{
    /**
     * Variable para indicar la tabla que mapea el modelo
     * 
     * @var string
     */
    protected $table = 'historia_cuenta';

    /**
     * Variable para la llave primaria de la tabla
     * 
     * @var string
     */
    protected $primaryKey = 'id_historia_cuenta';

    /**
     * Variable para que Eloquent ignore los campos timestamp (created_at y updated_at)
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Variable para indicar los campos o atributos que no son asignables en masa
     * 
     * @var array
     */
    protected $guarded = [];

    /* Relaciones con otros modelos */
    public function paciente()
    {
        return $this->belongsTo('App\OpticaModels\Paciente', 'id_paciente', 'id_paciente');
    }

    /* public function cuentasCobrar(){
        return $this->hasMany('App\OpticaModels\CuentaCobrar', 'id_historia_cuenta', 'id_historia_cuenta');
    } */
}
