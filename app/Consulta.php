<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    //
    protected $table = 'consulta';

    protected $primaryKey='id_consulta';

    public $timestamps = false;

    protected $guarded =[];

    public function jornadaTrabajo(){
        return $this->belongsTo('App\JornadaTrabajo','id_jornada_trabajo','id_jornada_trabajo');
    }

    public function historiaClinica(){
        return $this->belongsTo('App\HistoriaClinica','id_historia_clinica','id_historia_clinica');
    }

    public function consultaServicio(){
        return $this->hasMany('App\ConsultaServicio','id_consulta','id_consulta');
    }
}
