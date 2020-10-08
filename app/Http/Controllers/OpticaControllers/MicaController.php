<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\OpticaModels\Mica;
use App\Http\Requests\MicaFormRequest;

class MicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminmateriales.micas.index', ['micas'=>Mica::all()]);
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
    public function store(MicaFormRequest $request)
    {
        $mica = Mica::create([
            'mica' => $request->input('mica')
        ]);

        return redirect()->route('micas.index');
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
        return view('adminmateriales.micas.edit', ['mica' => Mica::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MicaFormRequest $request, $id)
    {
        $mica = Mica::findOrFail($id);
        $mica->update([
            'mica' => $request->input('mica')
        ]);
        return redirect()->route('micas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mica = Mica::findOrFail($id);
        $mica->update([
            'estado' => 0
        ]);
        return redirect('admin-materiales/micas');
    }
}
