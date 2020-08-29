<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Requests\JornadaTrabajoFormRequest;
use App\Jornada;
use App\JornadaTrabajo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\OpticaControllers\fullCalendar;

class JornadaController extends Controller
{
    //
    public function index(){
        return view('optometrista.jornadas.index');
    }

    public function pruebas(){
        return view('optometrista.jornadas.prueba');
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
            $jornadaT->id_jornada = $request->get('id_jornada');
            $jornadaT->id_departamento=$request->get('id_departamento');
            $jornadaT->nombre_jornada=$request->get('nombre_jornada');
            $jornadaT->lugar=$request->get('lugar');
            $jornadaT->fecha_jornada=$request->get('fecha_jornada');
           /* $jornadaT->fecha_final=$request->get('fecha_final');*/
            $jornadaT->hora_inicio=$request->get('hora_inicio');
            /*$jornadaT->hora_final=$request->get('hora_final');*/
            $jornadaT->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }
        /*return Redirect::to('jornadas');*/
        return response()->json($jornadaT);
    }

    //Funcion para mostrar los campos de jornada trabajo en el index
    public function mostrar(Request $request){
        //Para hacer joins es necesario usa DB en lugar de las relaciones de los modelos que no funka en jquery
        $jornada = JornadaTrabajo::where('estado','1')->get();
        if($request->ajax()){
            return DataTables::of($jornada)
                ->addIndexColumn()
                ->addColumn('opciones', function($row){
                    $btns = '
                    <div style="text-align:center">
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Editar">
                            <a href="#" data-target=".editJornada" data-toggle="modal" onclick="updateData('.$row->id_jornada_trabajo.')" class="btn btn-sm btn-neutral btn-raised waves-effect waves-blue waves-float">
<i class="zmdi zmdi-edit"></i>
                            </a>
                        </span>
                        <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Dar de Baja" data-original-title="Dar de Baja">
                            <a href="#" class="btn btn-sm btn-neutral btn-raised waves-effect darBaja waves-red waves-float"
                                data-type="confirm"
                                data-text="Se dara de baja la historia clinica '.$row->id_jornada_trabajo.'"
                                data-obj="Historia Clinica '.$row->id_jornada_trabajo.'">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                        </span>
                        </div>
                        ';

                    return $btns;
                })
                ->addColumn('tipo_jornada',function($row){
                    return $row->jornada->tipo_jornada;
                })
                ->addColumn('departamento',function($row){
                    return $row->departamento->departamento;
                })
                ->rawColumns(['opciones','tipo_jornada','departamento'])
                ->make(true);
        }
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
            $jornada->hora_inicio=$request->get('hora_inicio');
           /* $jornada->fecha_final=$request->get('fecha_final');*/
            /*$jornada->color_fondo=$request->get('color_fondo');*/

           /* $jornada->hora_final=$request->get('hora_final');*/
            $jornada->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return Redirect::to('jornadas');
    }

    public function fillCalendar(){
        $jornadas = JornadaTrabajo::where("estado","1")->get();

        $array=[];
        foreach ($jornadas as $jornada){
            $fullCalendar = new fullCalendar();
            $fullCalendar->title = $jornada->nombre_jornada;
            if($jornada->hora_inicio){
                $fullCalendar->start = $jornada->fecha_jornada.' '.$jornada->hora_inicio;
            }else{
                $fullCalendar->start = $jornada->fecha_jornada;
            }

            /*$fullCalendar->end = $jornada->fecha_final.' '.$jornada->hora_final;*/
            $fullCalendar->eventTextColor = $jornada->color_fondo;
            $fullCalendar->textColor = $jornada->color_texto;
            $fullCalendar->descripcion = $jornada->lugar;
            $fullCalendar->hora = $jornada->hora_inicio;
            $fullCalendar->id_departamento = $jornada->id_departamento;
            $fullCalendar->id_jornada = $jornada->id_jornada;
            $fullCalendar->id = $jornada->id_jornada_trabajo;
            $array[]=$fullCalendar;
        }
        return response()->json($array);
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
