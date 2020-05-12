<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\JornadaTrabajo;

class ConsultaController extends Controller
{
    //
    public function index(){
        return view('optometrista.consulta.index');
    }
    public function verjornada(){
        $jornada = DB::table('jornada_trabajo')->get()->where('estado','1');
        return response()->json($jornada);
    }

    public function gettable(){
        $consulta = DB::table('consulta')
            ->where('consulta.estado', '1')
            ->join('jornada_trabajo','consulta.id_jornada_trabajo','=','jornada_trabajo.id_jornada_trabajo')
            ->select('consulta.*','jornada_trabajo.nombre_jornada')
            ->get();
        return response()->json($consulta);
    }
    public function date(){

    }
}
