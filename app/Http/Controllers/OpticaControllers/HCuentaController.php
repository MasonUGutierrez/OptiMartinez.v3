<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\OpticaModels\Paciente;

class HCuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('tesorero.ordenLentes.ordenLentes');
    }

    //Funcion para obtener todos los pacientes
    public function getPacientes()
    {
        $paciente = DB::table('paciente')
            ->where('estado', 1)
            ->get();
        return response()->json($paciente);
    }
    //Funcion para obtener todos los datos de un solo paciente
    public function getPacienteById($id){
        $paciente = DB::table('paciente')
            ->where('estado', 1)
            ->where('id_paciente', $id)
            ->get();
        return response()->json($paciente);
    }
    //Funcion para obtener las marcas
    public function getMarcas(){
        $marca = DB::table('marca')
            ->where('estado',1)
            ->get();
        return response()->json($marca);
    }
    //Funcion para obtener todos los marcos de una marca
    public function getMarcos($id){
        $marcos =DB::table('marco')
            ->where('estado',1)
            ->where('id_marca',$id)
            ->get();
        return response()->json($marcos);
    }
    //Funcion para obtener los datos de un marco
    public function getMarcoInfo($id){
        $marcos =DB::table('marco')
            ->where('estado',1)
            ->where('id_marco',$id)
            ->get();
        return response()->json($marcos);
    }
    //Funcion para obtener los datos de la tabla tipo_lente
    public function getTipoLente(){
        $lente = DB::table('tipo_lente')
            ->where('estado',1)
            ->get();
        return response()->json($lente);
    }
    //Funcion para obtener los datos de la tabla tipo_material
    public function getTipoMaterial(){
        $material = DB::table('tipo_material')
            ->where('estado',1)
            ->get();
        return response()->json($material);
    }
    //Funcion para obtener los datos de la tabla marca_material
    public function getMarcaMaterial(){
        $marcaMaterial = DB::table('marca_material')
            ->where('estado',1)
            ->get();
        return response()->json($marcaMaterial);
    }
    //Funcion para obtener los datos de la tabla filtro
    public function getFiltro(){
        $filtro = DB::table('filtro')
            ->where('estado',1)
            ->get();
        return response()->json($filtro);
    }

    //Funcion que recibe como parametro el id del paciente para obtener su historia cuenta
    public function getHCuenta($id){
        $hCuenta = DB::table('historia_cuenta')
            ->where('estado',1)
            ->where('id_paciente',$id)
            ->get();
        return response()->json($hCuenta);
    }

    //Funcion para obtener los planes de pago
    public function getPlanPagos(){
        $planPagos = DB::table('plan_pago')
            ->where('estado',1)
            ->get();
        return response()->json($planPagos);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
