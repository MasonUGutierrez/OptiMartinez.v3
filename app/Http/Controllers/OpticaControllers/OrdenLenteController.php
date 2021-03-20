<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use App\OpticaModels\CuentaCobrar;
use App\OpticaModels\Filtro_Orden;
use App\OpticaModels\OrdenLentes;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\OpticaModels\Paciente;
use App\OpticaModels\Cuota;
use mysql_xdevapi\Table;

class OrdenLenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $paciente = DB::table('paciente')
            ->join('historia_clinica','paciente.id_paciente','=','historia_clinica.id_paciente')
            ->join('consulta','historia_clinica.id_historia_clinica','=','consulta.id_historia_clinica')
            ->join('consulta-servicio','consulta.id_consulta','=','consulta-servicio.id_consulta')
            ->join('examen_visual','consulta-servicio.id_consulta_servicio','=','examen_visual.id_consulta_servicio')
            ->where('examen_visual.orden_Flag',true)
            ->select('paciente.*','consulta.fecha')
            ->get();

        $tablaConcepto = DB::table('cuenta_cobrar')
            ->where('cuenta_cobrar.estado','=',1)
            ->join('historia_cuenta','cuenta_cobrar.id_historia_cuenta','=','historia_cuenta.id_historia_cuenta')
            ->join('paciente','historia_cuenta.id_paciente','=','paciente.id_paciente')
            ->join('orden_lente','cuenta_cobrar.id_cuenta_cobrar','=','orden_lente.id_cuenta_cobrar')
            ->join('marco','orden_lente.id_marco','=','marco.id_marco')
            ->join('tipo_lente','orden_lente.id_tipo_lente','=','tipo_lente.id_tipo_lente')
            ->join('material_mica-marca_material', 'orden_lente.id_material','=','material_mica-marca_material.id_material_marca')
            ->join('material_mica','material_mica-marca_material.id_material_mica','=','material_mica.id_material_mica')
            ->join('marca_material_mica','material_mica-marca_material.id_marca_material','=','marca_material_mica.id_marca_material')
            ->select('paciente.*','cuenta_cobrar.*','marco.cod_marco','tipo_lente.tipo_lente','material_mica.material_mica','marca_material_mica.marca_material')
            ->get();

        return view('tesorero.ordenLentes.ordenLentesView',['paciente'=>$paciente,'tablaConcepto'=>$tablaConcepto]);
    }

    public function vistaOrden(){
        return view('tesorero.ordenLentes.ordenLentes');
    }

    ///////////////////////Extraer costos//////////////////////
    /// Material, Marco, Tipo Lente
    public function costos($idMarco,$idTipoLente,$idMaterial){
        $marcos = DB::table('marco')
            ->where('id_marco',$idMarco)
            ->first();
        $tipoLente = DB::table('tipo_lente')
            ->where('id_tipo_lente', $idTipoLente)
            ->first();
        $material = DB::table('material_mica-marca_material')
            ->where('id_material_marca',$idMaterial)
            ->first();

        $datos =[$marcos,$tipoLente,$material];

        return response()->json($datos);
    }
    /// Filtro por ID
    public function costoFiltro($id){
        $filtro = DB::table('filtro')
            ->where('id_filtro',$id)
            ->select("filtro.precio")
            ->first();
        return response()->json($filtro);
    }



    //////////////////////////////////////////////////////////



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
    /*public function getTipoMaterial(){
        $material = DB::table('tipo_material')
            ->where('estado',1)
            ->get();
        return response()->json($material);
    }*/
    //Funcion para obtener los datos de la tabla marca_material
    public function getMarcaMaterial(){
        $marcaMaterial = DB::table('marca_material_mica')
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

    //Obtener fecha de la consulta
    public function getHClinica($id){
        $historia = DB::table('historia_clinica')
            ->where('estado',1)
            ->where('id_paciente',$id)
            ->select('historia_clinica.id_historia_clinica')
            ->first();

        /*dd($historia[0]->id_historia_clinica);*/
       /* $consulta = DB::table('consulta')
            ->where('estado',1)
            ->where('id_historia_clinica',$historia->id_historia_clinica)
            ->latest('id_consulta')
            ->first();*/
        return response()->json($historia);
    }

    public function getFecha($id){
        $consulta = DB::table('consulta')
            ->where('estado',1)
            ->where('id_historia_clinica',$id)
            ->latest('id_consulta')
            ->first();
        return response()->json($consulta);
    }

    //Funcion para extraer de la tabla material_mica-marca_material y los nombres de mica y marca de mica
    public function getMicaMarca(){
        $intermedia = DB::table('material_mica-marca_material')
            ->where('material_mica-marca_material.estado',1)
            ->join('material_mica','material_mica-marca_material.id_material_mica','=','material_mica.id_material_mica')
            ->join('marca_material_mica','material_mica-marca_material.id_material_marca','=','marca_material_mica.id_marca_material')
            ->select('material_mica-marca_material.id_marca_material','material_mica-marca_material.precio','material_mica.material_mica','marca_material_mica.marca_material')
            ->orderBy('marca_material_mica.marca_material', "desc")
            ->get();

        return response()->json($intermedia);
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
        $cuentaCobrar = new CuentaCobrar();
        $cuentaCobrar -> id_historia_cuenta = $request -> get('id_historia_cuenta');
        $cuentaCobrar -> id_plan_pago = $request -> get('id_plan_pago');
        $cuentaCobrar -> fecha = $request -> get('fecha');
        $cuentaCobrar -> monto_total = $request ->get('monto_total');
        $cuentaCobrar ->save();

        if ($request-> has('monto_cuota')){
            $monto = new Cuota();
            $monto -> monto_cuota = $request ->get('monto_cuota');
            $monto -> id_cuenta_cobrar = $cuentaCobrar -> id_cuenta_cobrar;
            $monto -> fecha = $cuentaCobrar -> fecha;
            $monto ->save();
        }


        $ordenLente = new OrdenLentes();
        $ordenLente -> id_cuenta_cobrar = $cuentaCobrar->id_cuenta_cobrar;
        $ordenLente -> id_marco = $request -> get('id_marco');
        $ordenLente -> id_material = $request -> get('id_material');
        $ordenLente -> id_tipo_lente = $request -> get('id_tipo_lente');
        $ordenLente -> costo_marco = $request ->get("costo_marco");
        $ordenLente -> costo_material = $request ->get("costo_material");
        $ordenLente -> costo_tipo_lente = $request ->get("costo_tipo_lente");
        $ordenLente -> costo_filtros = $request ->get("costo_filtros");
        $ordenLente->save();

        $cont = 0;



        $filtroCont = $request ->get('filtroCont');
        $filtros = $request ->get('filtros');



        while($cont < (int)$filtroCont){
            $filtroOrden = new Filtro_Orden();
            $filtroOrden -> id_filtro = $filtros[$cont][0];
            $filtroOrden -> id_orden_lente = $ordenLente -> id_orden_lente;
            $filtroOrden -> precio = $filtros[$cont][1];
            $filtroOrden->save();
            $cont++;
        }
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
