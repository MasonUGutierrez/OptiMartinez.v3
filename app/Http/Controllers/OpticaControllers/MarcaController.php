<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\OpticaModels\Marca;
use App\Http\Requests\MarcaFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
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

        $marcas = Marca::where('estado', '1')->paginate(8);

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
        // $marca = new Marca;

        // $marca->marca = $request->get('marca');
        // $marca->precio = $request->get('precio');

        // $marca->save();
        
        // Guardando un registro en una sola linea usando el metodo Create del modelo
        // Usar el metodo create evita tener que especificar de uno en uno cada atributo y usar el metodo save()
        $marca = Marca::create([
            'marca' => $request->input('marca'),
            'precio' => $request->input('precio')
        ]);
        
        if($request->hasFile('img')) // Comprobando que se haya subido un archivo
        {
            // Obteniendo el nombre y extension del archivo subido
            /**
             * img[0] -> Contendra el nombre del archivo
             * img[1] -> Contendra la extension del archivo
            */
            $img[0] = $request->file('img')->getClientOriginalName();
            $img[1] = $request->file('img')->extension(); 
            
            // Guardando el archivo en el disco local
            $path = $request->file('img')->storeAs('imagenes/marcas', implode('.', $img), 'public');
            
            // Guardando el nombre del archivo en registro recien guardado
            $marca->fill([
                'img' => $img[0]
            ]);
        }

        /* if($request->hasFile('img') && $request->file('img')->isValid() )
        {
            $archivo = $request->file('img');
            $nombreImg = $archivo->getClientOriginalName();
            $archivo->move('imagenes/marcas', $nombreImg);

            $marca->fill([
                'img' => $nombreImg
            ]);
        } */


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

        /* $nombreImgSinExtension = explode('.', $marca->img);
        $archivo = $request->file('img');

        // Comprueba si el nombre del archivo subido es diferente al que ya esta guardando entonces actualiza
        if($archivo->getClientOriginalName() != $nombreImgSinExtension[0])
        {
            // Obteniendo el nombre y extension del archivo subido
            $img[0] = $archivo->getClientOriginalName();
            $img[1] = $archivo->extension();

            Storage::disk('public')->delete('imagenes/marcas'.$marca->img);
            
            $path = $archivo->storeAs('imagenes/marcas', implode('.', $img), 'public');
            $marca->img = $img[0];
        } */

        if($request->hasFile('img') && $request->file('img')->isValid())
        {
            $img[0] = $request->file('img')->getClientOriginalName();
            $img[1] = $request->file('img')->extension();

            $path = $request->file('img')->storeAs('imagenes/marcas', implode('.', $img), 'public');
            $marca->img = $img[0];
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
