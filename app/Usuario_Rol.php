<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario_Rol extends Model
{
    //
    protected $table='usuario-rol';

    protected $primaryKey='id_usuario-rol';

    public $timestamps = false;

    protected $fillable=[
        'id_usuario',
        'id_rol',
    ];
}
