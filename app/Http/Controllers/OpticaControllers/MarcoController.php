<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\OpticaModels\Marco;
use App\OpticaModels\TipoMarco;
use App\OpticaModels\Marca;

class MarcoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcos_activos = Marco::where('estado',1)->get();
        $marcos_inactivos = Marco::where('estado',0)->get();
        return response()->view('adminlentes.marcos.index', ['marcos_activos'=>$marcos_activos, 'marcos_inactivos'=>$marcos_inactivos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // Prueba para validar el registro de un marco, si se desea guardar desde el atajo de marca o desde la vista principal de los marcos
        /* $previous = url()->previous();
        dd($previous); */

        $tiposMarcos = TipoMarco::where('estado','1')->get();
        $marcas = Marca::where('estado','1')->get();
        return response()->view('adminlentes.marcos.create', ['tiposMarcos'=>$tiposMarcos, 'marcas'=>$marcas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return response()->view('adminlentes.marcos.edit', ['marco'=>Marco::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
