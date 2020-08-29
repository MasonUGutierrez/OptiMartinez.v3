<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //
    protected $table = 'departamento';

    protected $primaryKey='id_departamento';

    public $timestamps = false;

    protected $guarded =[];

    public function jornadaTrabajo(){
        return $this->hasMany('App\JornadaTrabajo','id_departamento','id_departamento');
    }
}
