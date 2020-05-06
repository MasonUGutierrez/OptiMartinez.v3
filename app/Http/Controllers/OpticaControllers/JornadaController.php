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

    public function departamento(){
        $depar= DB::table('departamento')->get()->where('estado','1');
        return response()->json($depar);
    }

    public function vertipojornada(){
        $tipojor = DB::table('jornada')->get()->where('estado','1');
        return response()->json($tipojor);
    }

    public function store(JornadaTrabajoFormRequest $request){
        try{
            DB::beginTransaction();
            $jornada = new JornadaTrabajo();
            /*$jornada->id_jornada = $request->get('id_jornada');
            $jornada->id_departamento = $request->get('id_departamento');*/
            $jornada->id_jornada = $request->get('id_jornada');
            $jornada->id_departamento=$request->get('id_departamento');
            $jornada->nombre_jornada=$request->get('nombre_jornada');
            $jornada->lugar=$request->get('lugar');
            $jornada->fecha_jornada=$request->get('fecha_jornada');
            $jornada->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }
        return Redirect::to('jornadas');
    }

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

    public function edit($id){
        $jornada = DB::table('jornada_trabajo')
            ->where('id_jornada_trabajo',$id)
            ->join('jornada', 'jornada_trabajo.id_jornada', '=', 'jornada.id_jornada')
            ->join('departamento', 'jornada_trabajo.id_departamento', '=', 'departamento.id_departamento')
            ->select('jornada_trabajo.*', 'jornada.tipo_jornada', 'departamento.departamento')
            ->get();
        return response()->json($jornada);
    }

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
    public function destroy($id){
        $jornada = JornadaTrabajo::findOrFail($id);
        $jornada->estado = '0';
        $jornada->update();
        /*return Redirect::to('planpago');*/
        response()->json($jornada);
    }

}
