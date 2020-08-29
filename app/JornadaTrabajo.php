<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JornadaTrabajo extends Model
{
    //
    protected $table = 'jornada_trabajo';

    protected $primaryKey='id_jornada_trabajo';

    public $timestamps = false;

    protected $guarded =[];

    public function departamento(){
        return $this->belongsTo('App\Departamento','id_departamento','id_departamento');
    }

    public function jornada(){
        return $this->belongsTo('App\Jornada','id_jornada','id_jornada');
    }

    public function consulta(){
        return $this->hasMany('App\Consulta','id_jornada_trabajo','id_jornada_trabajo');
    }
}
