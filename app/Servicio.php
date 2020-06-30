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

    // Relaciones con otros modelos
    public function consultas()
    {
        return $this->belongsToMany('App\OpticaModels\Consulta');
    }
}
