<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\OpticaModels\TipoMaterial;
use App\Http\Requests\TipoMaterialFormRequest;

class TipoMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminlentes.tipomateriales.index', ['tiposMateriales'=>TipoMaterial::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminlentes.tipomateriales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoMaterialFormRequest $request)
    {
        $tipoMaterial = TipoMaterial::create([
            'tipo_material' => $request->input('tipo_material'),
            'precio' => $request->input('precio')
        ]);

        return redirect()->route('materiales.index');
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
        return view('adminlentes.tipomateriales.edit', ['tipoMaterial' => TipoMaterial::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoMaterialFormRequest $request, $id)
    {
        $tipoMaterial = TipoMaterial::findOrFail($id);
        $tipoMaterial->update([
            'tipo_material' => $request->input('tipo_material'),
            'precio' => $request->input('precio')
        ]);
        return redirect()->route('materiales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoMaterial = TipoMaterial::findOrFail($id);
        $tipoMaterial->update([
            'estado' => 0
        ]);
        return redirect('admin-lentes/materiales');
    }
}
