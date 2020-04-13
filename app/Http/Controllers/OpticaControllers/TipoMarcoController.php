<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\OpticaModels\TipoMarco;
use App\Http\Requests\TipoMarcoFormRequest;



class TipoMarcoController extends Controller
{
    public function __construct()
    {

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposMarcos = TipoMarco::orderBy('id_tipo_marco', 'desc')->paginate(10);
        return view('adminlentes.tipomarcos.index', ['tiposMarcos' => $tiposMarcos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminlentes.tipomarcos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoMarcoFormRequest $request)
    {
        $tipoMarco = TipoMarco::create([
            'tipo_marco' => $request->input('tipo_marco'),
        ]);
        return redirect()->route('tipos-marcos.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Nota: Se quito el $request porque este metodo servira solo para actualizar el atributo estado. 
    // Con el $request esperaba validar el dato en el campo tipo_marco que en si no existe
    public function update($id)
    {
        $tipoMarco = TipoMarco::findOrFail($id);
        // dd($id);
        $tipoMarco->estado = 1;
        $tipoMarco->save();

        return redirect()->route('tipos-marcos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoMarco = TipoMarco::findOrFail($id);
        $tipoMarco->estado = 0;
        $tipoMarco->save();

        return redirect('admin-lentes/tipos-marcos');
    }
}
