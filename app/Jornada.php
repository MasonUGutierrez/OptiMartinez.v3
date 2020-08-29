<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    //
    protected $table = 'jornada';

    protected $primaryKey='id_jornada';

    public $timestamps = false;

    protected $guarded =[];

    public function jornadaTrabajo(){
        return $this->hasMany('App\JornadaTrabajo','id_jornada','id_jornada');
    }
}
