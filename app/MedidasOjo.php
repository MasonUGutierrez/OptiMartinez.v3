<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedidasOjo extends Model
{
    //
    protected $table = 'medidas_ojo';

    protected $primaryKey='id_medidas_ojo';

    public $timestamps = false;

    protected $guarded =[];

    public function ExamenVisual(){
        $this->belongsTo('App\ExamenVisual','id_examen_visual','id_examen_visual');
    }
}
