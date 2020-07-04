<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Consulta;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultaFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\JornadaTrabajo;
use App\Servicio;
use App\OpticaModels\HClinica;
use App\ConsultaServicio;
use App\ExamenVisual;
use App\Retinoscopia;
use App\MedidasOjo;
use DataTables;

class ConsultaController extends Controller
{
    //
    public function index(){
        return view('optometrista.consulta.index');
    }

    //Esta funcion hace que muestre en un select las jornada trabajo
    public function verjornada(){
        $jornada = DB::table('jornada_trabajo')->get()
            ->where('estado','1');

        return response()->json($jornada);
    }

    public function getfecha($id){
        $fecha = DB::table('jornada_trabajo')
            ->where('id_jornada_trabajo',$id)
            ->pluck('fecha_jornada')
            ->first();
        return response()->json($fecha);
    }

    public function create($id)
    {
        return view('hclinicas.add-consulta',["hclinica"=>HClinica::findOrFail($id)]);
    }

    public function show($id){
        $consulta = DB::table('consulta')
            ->where('consulta.id_consulta',$id)
            ->join('consulta-servicio','consulta.id_consulta','=','consulta-servicio.id_consulta')
            ->join('servicio','consulta-servicio.id_servicio','=','servicio.id_servicio')
            ->join('jornada_trabajo' , 'consulta.id_jornada_trabajo','=','jornada_trabajo.id_jornada_trabajo')
            ->select('consulta.*','consulta-servicio.*','servicio.servicio','jornada_trabajo.*')
            ->get()->toArray();

        $examen = DB::table('examen_visual')
            ->select('examen_visual.*','medidas_ojo.*')
            ->join('consulta-servicio','examen_visual.id_consulta_servicio','=','consulta-servicio.id_consulta_servicio')
            ->join('consulta','consulta-servicio.id_consulta','=','consulta.id_consulta')
            ->join('medidas_ojo','examen_visual.id_examen_visual','=','medidas_ojo.id_examen_visual')
            ->where('consulta.id_consulta',$id)
            ->get()->toArray();

        $retinoscopia = DB::table('retinoscopia')
            ->select('hallazgos')
            ->join('consulta-servicio','retinoscopia.id_consulta_servicio','=','consulta-servicio.id_consulta_servicio')
            ->join('consulta','consulta-servicio.id_consulta','=','consulta.id_consulta')
            ->where('consulta.id_consulta',$id)
            ->get()->toArray();

        return response()->json(["consulta"=>$consulta,"examen"=>$examen,"retinoscopia"=>$retinoscopia]);
    }

    public function servicio(){
        $servicio = DB::table('servicio')->get()
            ->where('estado','1')
            ->where('id_servicio','<','16');
        return response()->json($servicio);
    }

    //
    //
    //Esta mostrando los datos unicamente del id.historia_clinica
    //Cambiar esto cuando Mason pase su parte y pasar por parametro el valor de id.historia_clinica
    //
    //
    //
    public function gettable(Request $request, $id){
        $consulta = DB::table('consulta')
            ->where('consulta.estado', '1')
            ->where('consulta.id_historia_clinica',$id)
            ->join('jornada_trabajo','consulta.id_jornada_trabajo','=','jornada_trabajo.id_jornada_trabajo')
            ->join('historia_clinica','consulta.id_historia_clinica', '=','historia_clinica.id_historia_clinica')
            ->join('paciente','historia_clinica.id_paciente','=','paciente.id_paciente')
            ->select('consulta.*','paciente.nombre','paciente.apellido','jornada_trabajo.nombre_jornada','jornada_trabajo.fecha_jornada')
            ->get();

        if($request->ajax()){
            return DataTables::of($consulta)
                ->addIndexColumn()
                ->addColumn('opciones', function($row){
                    $btns = '
                    <div style="text-align:center">
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ver detalles" data-original-title="Editar">
                            <a href="consulta/'.$row->id_consulta.'"  data-target=".showConsulta" data-toggle="modal" onclick="verDetalles('.$row->id_consulta.')" class="btn btn-sm btn-neutral btn-raised waves-effect waves-blue waves-float">Detalles
                            </a>
                        </span>
                        <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Dar de Baja" data-original-title="Dar de Baja">
                            <a href="#"
                                                       class="btn btn-raised btn-danger waves-effect"
                                                       data-type="confirm"
                                                       data-title="Dar de Baja"
                                                       data-text="¿Desea eliminar el registro de esta Consuta?"
                                                       data-obj="'.$row->id_consulta.'"
                                                       onclick="delData('.$row->id_consulta.')">
                                                         <i class="ti-trash"></i>
                                                </a>
                        </span>
                        </div>';

                    return $btns;
                })
                ->rawColumns(['opciones'])
                ->make(true);
        }
        return response()->json($consulta);
    }

    public function getpaciente($id){
        $consulta = DB::table('historia_clinica')
            ->where('historia_clinica.estado', '1')
            ->where('historia_clinica.id_historia_clinica',$id)
            ->join('paciente','historia_clinica.id_paciente',"=","paciente.id_paciente")
            ->select('paciente.nombre','paciente.apellido')
            ->get();

        return response()->json($consulta);
    }

    public function store(ConsultaFormRequest $request){
        $consulta = new Consulta();
        $consulta->id_historia_clinica = $request->get('id_historia_clinica');
        $consulta->id_jornada_trabajo = $request ->get('id_jornada_trabajo');
        $consulta->fecha = $request->get('fecha');
        $consulta->save();

        $servicio = $request->get('id_servicio');
        $precio = $request->get('precio');
        $contaServicio= 0;
        while($contaServicio < count($servicio)){
            $consultaS = new ConsultaServicio();
            $consultaS->id_consulta = $consulta->id_consulta;
            $consultaS->id_servicio = $servicio[$contaServicio];
            $consultaS->precio = $precio[$contaServicio];
            $consultaS->save();
            if($contaServicio==0){

                $contaOjo=0;
                $esfera = $request->get('esfera');
                $cilindro = $request->get('cilindro');
                $eje = $request->get('eje');
                $adicion = $request->get('adicion');
                $agudeza_visual = $request->get('agudeza_visual');

                $examenvisual = new ExamenVisual();
                $examenvisual-> id_consulta_servicio = $consultaS->id_consulta_servicio;
                $examenvisual-> distancia_pupilar = $request->get('distancia_pupilar');
                $examenvisual-> alt = $request->get('alt');
                $examenvisual-> observacion = $request->get('observacion');
                $examenvisual->save();

                while ($contaOjo<count($esfera)){
                    $medidas = new MedidasOjo();
                    $medidas->id_examen_visual = $examenvisual->id_examen_visual;
                    $medidas->ojo = $contaOjo;
                    $medidas->esfera=$esfera[$contaOjo];
                    $medidas->cilindro=$cilindro[$contaOjo];
                    $medidas->eje=$eje[$contaOjo];
                    $medidas->adicion=$adicion[$contaOjo];
                    $medidas->agudeza_visual=$agudeza_visual[$contaOjo];
                    $medidas->save();
                    $contaOjo = $contaOjo + 1;
                }

            }else if($contaServicio == 1){
                $retinoscopia = new Retinoscopia();
                $retinoscopia->id_consulta_servicio = $consultaS->id_consulta_servicio;
                $retinoscopia->hallazgos = $request->get('hallazgos');
                $retinoscopia->save();
            }
            $contaServicio = $contaServicio + 1;
        }
        return Redirect::to('historias-clinicas/consulta/create');
    }
    public function update(ConsultaFormRequest $request,$id){

        $consulta = Consulta::findOrFail($id);
        $consulta->id_jornada_trabajo = $request ->get('id_jornada_trabajo');
        $consulta->save();
        DB::select('call borrar_examen(?)',array($id));
        $servicio = $request->get('id_servicio');
        $precio = $request->get('precio');
        $contaServicio= 0;
        while($contaServicio < count($servicio)){
            $consultaS = new ConsultaServicio();
            $consultaS->id_consulta = $consulta->id_consulta;
            $consultaS->id_servicio = $servicio[$contaServicio];
            $consultaS->precio = $precio[$contaServicio];
            $consultaS->save();
            if($contaServicio==0){

                $contaOjo=0;
                $esfera = $request->get('esfera');
                $cilindro = $request->get('cilindro');
                $eje = $request->get('eje');
                $adicion = $request->get('adicion');
                $agudeza_visual = $request->get('agudeza_visual');

                $examenvisual = new ExamenVisual();
                $examenvisual-> id_consulta_servicio = $consultaS->id_consulta_servicio;
                $examenvisual-> distancia_pupilar = $request->get('distancia_pupilar');
                $examenvisual-> alt = $request->get('alt');
                $examenvisual-> observacion = $request->get('observacion');
                $examenvisual->save();

                while ($contaOjo<count($esfera)){
                    $medidas = new MedidasOjo();
                    $medidas->id_examen_visual = $examenvisual->id_examen_visual;
                    $medidas->ojo = $contaOjo;
                    $medidas->esfera=$esfera[$contaOjo];
                    $medidas->cilindro=$cilindro[$contaOjo];
                    $medidas->eje=$eje[$contaOjo];
                    $medidas->adicion=$adicion[$contaOjo];
                    $medidas->agudeza_visual=$agudeza_visual[$contaOjo];
                    $medidas->save();
                    $contaOjo = $contaOjo + 1;
                }

            }else if($contaServicio == 1){
                $retinoscopia = new Retinoscopia();
                $retinoscopia->id_consulta_servicio = $consultaS->id_consulta_servicio;
                $retinoscopia->hallazgos = $request->get('hallazgos');
                $retinoscopia->save();
            }
            $contaServicio = $contaServicio + 1;
        }
        return Redirect::to('consulta');
    }

    //Funcion para eliminar los registros de consulta
    public function destroy($id){
        $consulta = Consulta::findOrFail($id);
        $consulta->estado = '0';
        $consulta->update();
        response()->json($consulta);
    }

}
