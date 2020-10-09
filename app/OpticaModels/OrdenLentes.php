<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class OrdenLentes extends Model
{
    //
    protected $table = "orden_lente";
    protected $primaryKey = "id_orden_lente";

    public $timestamps= false;

    protected $guarded = [];

    public function cuentaCobrar(){
        return $this->belongsTo('App\OpticaModels\CuentaCobrar','id_cuenta_cobrar','id_cuenta_cobrar');
    }
    public function filtros(){
        return $this->belongsToMany('App\OpticaModels\Filtro');
    }
    public function mica(){
        return $this->belongsTo('App\OpticaModels\Mica','id_mica','id_mica');
    }
    public function marco(){
        return $this->belongsTo('App\OpticaModels\Marco', 'id_marco','id_marco');
    }
    public function tipoLente(){
        return $this->belongsTo('App\OpticaModels\TipoLente','id_tipo_lente','id_tipo_lente');
    }

}
