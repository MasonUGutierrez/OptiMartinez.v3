<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

use App\OpticaModels\MaterialMica;
use App\Http\Requests\MaterialMicaFormRequest;

use App\OpticaModels\MarcaMaterial;

class MaterialMicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminmateriales.micas.index', ['materialesmica'=>MaterialMica::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminmateriales.micas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialMicaFormRequest $request)
    {
        $material = MaterialMica::create([
            'material_mica' => $request->input('material_mica')
        ]);

        return redirect()->route('materiales.index');
    }

    public function getMarcasMateriales()
    {
        
    }
    public function getCedulaifExist($ced)
    {
        try
        {
            if($pacienteWithCedula = Paciente::where('cedula',$ced)->firstOrFail())
            {
                return "true";
            }
        }
        catch(ModelNotFoundException $e)
        {
            return "false";
        }
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
        return view('adminmateriales.micas.edit', ['material_mica' => MaterialMica::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialMicaFormRequest $request, $id)
    {
        $material_mica = MaterialMica::findOrFail($id);
        $material_mica->update([
            'material_mica' => $request->input('material_mica')
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
        $material_mica = MaterialMica::findOrFail($id);
        $material_mica->update([
            'estado' => 0
        ]);
        return redirect('admin-materiales/materiales');
    }
}
