<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\OpticaModels\TipoLente;
use App\Http\Requests\TipoLenteFormRequest;

class TipoLenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('adminlentes.tipolentes.index', ['tiposLentes'=>TipoLente::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminlentes.tipolentes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoLenteFormRequest $request)
    {
        $tipoLente = TipoLente::create([
            'tipo_lente' => $request->input('tipo_lente'),
            'precio' => $request->input('precio')
        ]);
        
        return redirect()->route('tipos-lentes.index');
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
        return view('adminlentes.tipolentes.edit', ['tipoLente'=>TipoLente::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoLenteFormRequest $request, $id)
    {
        $tipoLente = TipoLente::findOrFail($id);
        $tipoLente->tipo_lente = $request->input('tipo_lente');
        $tipoLente->precio = $request->input('precio');
        $tipoLente->save();

        return redirect()->route('tipos-lentes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoLente = TipoLente::findOrFail($id);
        $tipoLente->estado = 0;
        $tipoLente->save();

        return redirect('admin-lentes/tipos-lentes');
    }
}
