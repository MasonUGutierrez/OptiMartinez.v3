<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Requests\JornadaTrabajoFormRequest;
use App\JornadaTrabajo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class JornadaController extends Controller
{
    //
    public function index(){
        return view('optometrista.jornadas.index');
    }

    //Funcion para obtener los nombres de los departamento en el select
    public function departamento(){
        $depar= DB::table('departamento')->get()->where('estado','1');
        return response()->json($depar);
    }
    //Funcion para obtener los nombres de tipo de jornadas en el select
    public function vertipojornada(){
        $tipojor = DB::table('jornada')->get()->where('estado','1');
        return response()->json($tipojor);
    }

    //Funcion para guardar una nueva jornada
    public function store(JornadaTrabajoFormRequest $request){
        try{
            DB::beginTransaction();
            $jornadaT = new JornadaTrabajo();
            /*$jornada->id_jornada = $request->get('id_jornada');
            $jornada->id_departamento = $request->get('id_departamento');*/
            $jornadaT->id_jornada = $request->get('id_jornada');
            $jornadaT->id_departamento=$request->get('id_departamento');
            $jornadaT->nombre_jornada=$request->get('nombre_jornada');
            $jornadaT->lugar=$request->get('lugar');
            $jornadaT->fecha_jornada=$request->get('fecha_jornada');
            $jornadaT->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }
        return Redirect::to('jornadas');
    }

    //Funcion para mostrar los campos de jornada trabajo en el index
    public function mostrar(){
        //Para hacer joins es necesario usa DB en lugar de las relaciones de los modelos que no funka en jquery
        $jornada = DB::table('jornada_trabajo')
            ->where('jornada_trabajo.estado','1')
            ->join('jornada', 'jornada_trabajo.id_jornada', '=', 'jornada.id_jornada')
            ->join('departamento', 'jornada_trabajo.id_departamento', '=', 'departamento.id_departamento')
            ->select('jornada_trabajo.*', 'jornada.tipo_jornada', 'departamento.departamento')
            ->get();
        return response()->json($jornada);
    }

    //Funcion para mostrar en el edit los registros de jornada trabajo
    public function edit($id){
        $jornada = DB::table('jornada_trabajo')
            ->where('id_jornada_trabajo',$id)
            ->join('jornada', 'jornada_trabajo.id_jornada', '=', 'jornada.id_jornada')
            ->join('departamento', 'jornada_trabajo.id_departamento', '=', 'departamento.id_departamento')
            ->select('jornada_trabajo.*', 'jornada.tipo_jornada', 'departamento.departamento')
            ->get();
        return response()->json($jornada);
    }
    //Funcion para actualizar los registros de jornada trabajo
    public function update(JornadaTrabajoFormRequest $request,$id)
    {
        try {
            DB::beginTransaction();
            $jornada = JornadaTrabajo::findOrFail($id);
            $jornada->id_jornada = $request->get('id_jornada');
            $jornada->id_departamento = $request->get('id_departamento');
            $jornada->nombre_jornada = $request->get('nombre_jornada');
            $jornada->lugar = $request->get('lugar');
            $jornada->fecha_jornada = $request->get('fecha_jornada');
            $jornada->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return Redirect::to('jornadas');
    }
    //Funcion para eliminar los registros de jornada
    public function destroy($id){
        $jornada = JornadaTrabajo::findOrFail($id);
        $jornada->estado = '0';
        $jornada->update();
        /*return Redirect::to('planpago');*/
        response()->json($jornada);
    }

}
