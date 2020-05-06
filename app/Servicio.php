<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //
    protected $table='servicio';

    protected $primaryKey='id_servicio';

    public $timestamps = false;

    protected $fillable=[
        'servicio',
        'precio',
        'estado'
    ];

    public function ConsultaServicio(){
        $this -> hasMany('App\ConsultaServicio','id_servicio','id_servicio');
    }
}
