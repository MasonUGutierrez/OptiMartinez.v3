<?php

namespace App\OpticaModels;

use Illuminate\Database\Eloquent\Model;

class TipoLente extends Model
{
    /**
     * Variable para indicar la tabla
     * 
     * @var string
     */
    protected $table = 'tipo_lente';

    /**
     * Variable para indicar la llave primaria
     *
     * @var int
     */
    
    protected $primaryKey = 'id_tipo_lente';

    /** 
     * Variable para que Eloquent no considere los campos created_at y updated_at
     * 
     * @var boolean
     */
    public $timestamps = false;

    // Proteccion de atributos contra asignaciones en masa

    /**
     * Atributos o Campos que son asignables en masa en la tabla
     * 
     * @var array
     */
    /* protected $fillable = [
        'tipo_lente',
        'precio',
        'estado'
    ]; */

    /**
     * Atributos o Campos que no son asignables en masa en la tabla
     * 
     * @var array
     */
    protected $guarded = [];

    // Solo se debe ocupar la propiedad $fillable o $guarded
    // Especificar $guarded vacio indica que todos los campos estan protegidos de asignacion en masa

    // Relaciones con los otros modelos

}
