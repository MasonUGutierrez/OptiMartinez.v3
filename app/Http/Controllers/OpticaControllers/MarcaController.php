<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\OpticaModels\Marca;
use App\Http\Requests\MarcaFormRequest;
use Illuminate\Support\Facades\Storage;
use DB;

class MarcaController extends Controller
{
    /**
     * Metodo contructor del Controlador
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* if($request)
        {
            $query = trim($request->get('searchText'));
            $marcas = DB::table('marca')
                        ->where('marca', '%'.$query.'%')
                        ->where('estado', '1')
                        ->ordeBy('id_marca','desc)
                        ->paginate(4);

            return view('adminlentes.marcas.index', ['marcas' => $marcas, 'searchText' => $query]); 
        }
        */

        $marcas = Marca::where('estado', '1')->orderBy('id_marca','asc')->paginate(8);

        return view('adminlentes.marcas.index', ['marcas' => $marcas]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminlentes.marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MarcaFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaFormRequest $request)
    {        
        // Guardando un registro en una sola linea usando el metodo Create del modelo
        $marca = Marca::create([
            'marca' => $request->input('marca'),
            'precio' => $request->input('precio')
        ]);
        // $marca = new Marca;
        
        
        if($request->hasFile('img')) // Comprobando que se haya subido un archivo
        {
            $nombreImg = $request->file('img')->getClientOriginalName();

            // Guardando el archivo en el disco local 'public'            
            $path = $request->file('img')->storeAs('imagenes/marcas', $nombreImg, 'public');
            
            // Guardando el nombre del archivo en el registro recien guardado            
            $marca->fill(['img' => $nombreImg]);
            $marca->save();
        }

        return redirect('admin-lentes/marcas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = Marca::findOrFail($id);
        return view('adminlentes.marcas.show', ['marca' => $marca]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marca = Marca::findOrFail($id);
        return view('adminlentes.marcas.edit', ['marca' => $marca]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\MarcaFormRequests  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaFormRequest $request, $id)
    {
        $marca = Marca::findOrFail($id);

        $marca->marca = $request->input('marca');
        $marca->precio = $request->input('precio');

        $archivo = $request->file('img');
        if($request->hasFile('img') && $archivo->isValid() && $archivo->getClientOriginalName() !== $marca->img)
        {
            $nombreImg = $archivo->getClientOriginalName();
        
            Storage::disk('public')->delete('imagenes/marcas'.$marca->img); // Elimina del disco la imagen ubicada en el path enviado por parametro

            $path = $archivo->storeAs('imagenes/marcas', $nombreImg, 'public');
            $marca->img = $nombreImg;
        }

        $marca->save();

        return redirect('admin-lentes/marcas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marca = Marca::findOrFail($id);        
        $marca->estado = 0;
        $marca->save();

        return redirect('admin-lentes/marcas');
    }
}
