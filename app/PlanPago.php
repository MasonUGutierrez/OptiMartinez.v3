<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanPago extends Model
{
    //
    protected $table='plan_pago';

    protected $primaryKey='id_plan_pago';

    public $timestamps = false;

    protected $fillable=[
        'plan_pago',
        'descripcion',
        'estado'
    ];

    public  function cuentasCobrar(){
        return $this->hasMany('App\OpticaModels\CuentaCobrar','id_cuenta_cobrar' , 'id_cuenta_cobrar');
    }
}
