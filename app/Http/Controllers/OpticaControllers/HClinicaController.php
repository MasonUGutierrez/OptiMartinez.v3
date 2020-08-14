<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\HClinicaFormRequest;
use App\OpticaModels\HClinica;
use DataTables;

// Clases opcionales
use App\OpticaModels\Paciente;
use App\OpticaModels\HCuenta;
use Illuminate\Database\Eloquent\ModelNotFoundException;

// use Exception;

class HClinicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hclinica = HClinica::where('estado', '1')->latest('fecha_registro')->get();
        return response()->view('hclinicas.index',['hclinicas' => $hclinica]);
    }

    public function getAll(Request $request)
    {
        if($request->ajax()){
            $hclinicas = HClinica::where('estado', '1')->get();
            // return response()->json($hclinicas);
            
            return DataTables::of($hclinicas)
                ->addIndexColumn()
                ->addColumn('opciones', function($row){
                    $btns = '
                    <div style="text-align:center">
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ver detalles" data-original-title="Editar">
                            <a href="'.route('historias-clinicas.show',$row->id_historia_clinica).'" class="btn btn-sm btn-neutral btn-raised waves-effect waves-blue waves-float">
                                <i class="zmdi zmdi-search"></i>
                            </a>
                        </span>
                        <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Dar de Baja" data-original-title="Dar de Baja">
                            <a href="'.action("OpticaControllers\HClinicaController@destroy", $row->id_historia_clinica).'" class="btn btn-sm btn-neutral btn-raised waves-effect darBaja waves-red waves-float"
                                data-type="confirm"
                                data-text="Se dara de baja la historia clinica '.$row->id_historia_clinica.'"
                                data-obj="Historia Clinica '.$row->id_historia_clinica.'">
                                <i class="zmdi zmdi-delete"></i>    
                            </a>
                        </span>
                        </div>';

                    return $btns;
                })
                ->addColumn('paciente', function($row){
                    return $row->paciente->nombres . ' ' . $row->paciente->apellidos;
                })
                ->rawColumns(['opciones', 'paciente'])
                ->make(true);
        }
    }

    public function getHClinica($id)
    {
        $hclinica = HClinica::findOrFail($id);
        // $paciente = $hclinica->paciente;
        // $consultaServicio = \App\OpticaModels\ConsultaServicio::where('id_consulta', $hclinica->consulta);
        return response()->json($hclinica);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\HClinicaFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HClinicaFormRequest $request)
    {
        // Estableciendo la zona horaria, mirar si se deja un valor por default en la BD mejor
        date_default_timezone_set('America/Managua');
        $fecha_actual = date('Y-m-d', strtotime('now'));

        if($request->ajax())
        {
            // return "Ajax error";
            $paciente = Paciente::create([
                'nombres' => $request->get('nombres'),
                'apellidos'=> $request->get('apellidos'),
                'fecha_nacimiento'=>$request->get('fecha_nacimiento'),
                'edad'=> $request->get('edad'),
                'sexo'=>$request->get('sexo'),
                'cedula'=> $request->get('cedula'),
                'telefono'=> $request->get('telefono'),
                'direccion'=> $request->get('direccion')
            ]);
            // return response()->json($paciente);
            
            $paciente->hclinica()->create([
                'h_ocular' => $request->get('h_ocular'),
                'h_medica' => $request->get('h_medica'),
                'medicaciones' => $request->get('medicaciones'),
                'alergias' => $request->get('alergias'),
                'fecha_registro' => $fecha_actual
            ]);
            
            $hcuenta = new HCuenta([
                'estado_historia' => 'solvente',
                'fecha_registro' => $fecha_actual
            ]);

            $paciente->hcuenta()->save($hcuenta);

            return response()->json($paciente);
        }
// 
        return redirect()->action('OpticaControllers\HClinicaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hclinica = HClinica::findOrFail($id);
        // try-catch porque ocurre una excepcion 404 cuando la historia clinica no tiene consultas registradas
        // Algoritmo para determinar las medidas de la ultima consulta en la historia clinica determinada
        try{
            $ultimaConsulta = $hclinica->consultas()->latest('fecha')->firstOrFail();
            $uConsultaServicio = \App\OpticaModels\ConsultaServicio::where('id_consulta',$ultimaConsulta->id_consulta)->get();
        }catch(ModelNotFoundException $e)
        {
            session()->flash('error_message', 'No se han encontrado registros de medidas');
            return view('hclinicas.show', ['hclinica'=>$hclinica, 'uConsultaServicios'=>null]);
            // dd($e);
        }
        return view('hclinicas.show', ['hclinica'=>$hclinica, 'uConsultaServicios'=>$uConsultaServicio]);

        // dd($ultimaConsulta);

        // Array con las consultas servicios de la ultima consulta por determinada historia clinica
        // $uMedidas = 
        // dd($uConsultaServicio[0]->examenVisual->medidasOjos);
        // $consultaServicio = $hclinica->consultas()->latest('fecha')->first()->servicios()->first()->consultaServicio;
        // dd($consultaServicio->servicio->servicio);
        // dd($consultaServicio->examenVisual->observacion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\HClinicaFormRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HClinicaFormRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $hclinica = HClinica::findOrFail($id);
       $hclinica->estado = 0;
       $hclinica->save();

       return "Registro dado de baja";
    }
}
