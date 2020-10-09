<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class CuentaCobrar extends Model
{
    //
    protected $table = 'cuenta_cobrar';
    protected $primaryKey = 'id_cuenta_cobrar';
    public $timestamps = false;
    protected $guarded = [];

    public function historiaCuenta(){
        return $this->belongsTo('App\OpticaModels\HCuenta','id_historia_cuenta','id_historia_cuenta');

    }
    public function ordenLente(){
        return $this->hasOne('App\OpticaModels\OrdenLente','id_cuenta_cobrar','id_cuenta_cobrar');
    }
    public function planpago(){
        return $this->belongsTo('App\PlanPago','id_plan_pago','id_plan_pago');
    }
}
