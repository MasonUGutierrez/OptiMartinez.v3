<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='usuario';

    protected $primaryKey='id_usuario';

    public $timestamps = false;

    // Las propiedades rellenables del modelo deben ir entre ''
    protected $fillable=[
        'cod_minsa',
        'nombre',
        'apellido',
        'cedula',
        'telefono',
        'correo',
        'dir_foto',
        'contraseña',
        'descripcion',
        'estado'
    ];
    // Agregue el atributo estado   

    // Relacion Mucho a Mucho con Rol
    public function roles()
    {
        return $this->belongsToMany('App\Rol', 'usuario-rol', 'id_usuario', 'id_rol');
    } 
}
