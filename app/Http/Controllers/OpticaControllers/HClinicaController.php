<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\HClinicaFormRequest;
use App\OpticaModels\HClinica;

// Clases opcionales
use App\OpticaModels\Paciente;
use App\OpticaModels\HCuenta;

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
            return response()->json($hclinicas);
        }
    }

    public function getPaciente($id)
    {
        $hclinica = HClinica::findOrFail($id);
        $paciente = $hclinica->paciente;

        return response()->json($paciente);
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
                'nombre' => $request->get('nombre'),
                'apellido'=> $request->get('apellido'),
                'edad'=> $request->get('edad'),
                'cedula'=> $request->get('cedula'),
                'telefono'=> $request->get('telefono'),
                'direccion'=> $request->get('direccion')
            ]);
            // return response()->json($paciente);
            
            $paciente->hclinica()->create([
                'antecedentes' => $request->get('antecedentes'),
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
        //
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
        //
    }
}
