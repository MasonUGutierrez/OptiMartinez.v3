<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamenVisual extends Model
{
    //
    protected $table = 'examen_visual';

    protected $primaryKey='id_examen_visual';

    public $timestamps = false;

    protected $guarded =[];

    public function ConsultaServicio(){
        $this->belongsTo('App\ConsultaServicio','id_examen_visual','id_examen_visual');
    }

    public function ExamenVisual(){
        $this->hasMany('App\MedidasOjo','id_examen_visual','id_examen_visual');
    }
}
