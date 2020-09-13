<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultaServicio extends Model
{
    //
    protected $table = 'consulta-servicio';

    protected $primaryKey='id_consulta_servicio';

    public $timestamps = false;

    protected $guarded =[];

    public function Servicio(){
        $this->belongsTo('App\Servicio','id_servicio','id_servicio');
    }

    public function Consulta(){
        $this->belongsTo('App\Consulta','id_consulta','id_consulta');
    }

    public function ExamenVisual(){
        $this->hasOne('App\ExamenVisual','id_consulta_servicio','id_consulta_servicio');
    }

    public function Retinoscopia(){
        $this->hasOne('App\Retinoscopia','id_consulta_servicio','id_consulta_servicio');
    }
}
