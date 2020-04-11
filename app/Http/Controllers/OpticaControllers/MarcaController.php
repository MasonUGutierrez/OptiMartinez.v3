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
     * Metodo para realizar manualmente la regla unique con las imagenes
     * 
     * @param file $img indica el nombre de la imagen a buscar
     * @param App\Http\Requests\MarcaFormRequest $request servira para obtener el metodo con el que se esta haciendo el request
     * @param int $id parametro opcional tendra el valor del id del modelo que esta actualizando para que cuando busque en la bd si algun registro tiene la imagen omita este registro
     * @return App\Model retorna el modelo en caso de encontrar uno que tenga registrada la imagen
     */
    public function existImage($img, MarcaFormRequest $request, $id = null)
    {
        // Practicando switch
        switch($request->method())
        {
            // Caso en que se este registrando
            case 'POST':
                return Marca::where([
                    ['img', 'like', "%$img"],
                    ['estado', '1'],
                    ])->first();
            break;
            // Caso en que se este actualizando, se omite el registro del elemento que se esta actualizando
            case 'PUT':
                return Marca::where([
                    ['img','like',"%$img"],
                    ['estado', 1],
                    ['id_marca','<>', $id],
                ])->first();
            break;
        }       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MarcaFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaFormRequest $request)
    {        
        // Observacion: En php para llamar una funcion definida dentro una clase hay que llamarla como si fuera un metodo de la clase con $this->metodo()   
        if($this->existImage($request->file('img')->getClientOriginalName(), $request))
        {
            return back()
                    ->withErrors(['img' => 'La imagen ya ha sido tomada'])
                    ->withInput();
        }

        // Guardando un registro en una sola linea usando el metodo Create del modelo
        $marca = Marca::create([
            'marca' => $request->input('marca'),
            'precio' => $request->input('precio')
        ]);

        if($request->hasFile('img') && $request->file('img')->isValid()) // Comprobando que se haya subido un archivo
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
        
        // Guardara la foto si se subio un archivo, si es un archivo valido, y si el nombre del archivo es diferente al que ya esta guardado
        if($archivo != null)
        {
            // Se valida si existe un registro con la imagen que se quiere actualizar
            if($this->existImage($archivo->getClientOriginalName(), $request, $marca->id_marca))
            {
                return back()
                    ->withErrors(['img' => 'La imagen ya ha sido tomada'])
                    ->withInput();
            }
            if($request->hasFile('img') && $archivo->isValid() && $archivo->getClientOriginalName() !== $marca->img)
            {
                $nombreImg = $archivo->getClientOriginalName();
                
                // Elimina del disco la imagen ubicada en el path enviado por parametro
                // De esta manera se optimiza el almacenaje de imagenes
                Storage::disk('public')->delete('imagenes/marcas/'.$marca->img);
    
                $path = $archivo->storeAs('imagenes/marcas', $nombreImg, 'public');
                $marca->img = $nombreImg;
            }
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
