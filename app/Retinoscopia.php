<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retinoscopia extends Model
{
    //
    protected $table = 'retinoscopia';

    protected $primaryKey='id_retinoscopia';

    public $timestamps = false;

    protected $guarded =[];

    public function ConsultaServicio(){
        $this->belongsTo('App\ConsultaServicio','id_consulta_servicio','id_consulta_servicio');
    }
}
