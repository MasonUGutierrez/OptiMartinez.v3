<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    //
    protected $table = 'cuota';

    protected  $primaryKey = 'id_cuota';

    public $timestamps = false;

    protected $guarded = [];

    public function cuentaCobrar()
    {
        return $this->belongsTo('App\OpticaModels\CuentaCobrar', 'id_cuenta_cobrar', 'id_cuenta');
    }

}
