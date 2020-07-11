<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\OpticaModels\Marco;
use App\OpticaModels\TipoMarco;
use App\OpticaModels\Marca;
use App\Http\Requests\MarcoFormRequest;
use Illuminate\Support\Facades\Storage;

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
     * Metodo para simular la regla unique en la imagen
     * 
     * @param string $img orinalName de la imagen que se quiere guardar
     * @param App\Http\Requests\MarcoFormRequest $request
     * @param int $id
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function existImage($img, MarcoFormRequest $request, $id = null)
    {
        // echo "entro";
        switch($request->method())
        {
            case 'POST':
                return Marco::where([
                    ['dir_foto', 'like', "%$img"],
                    ['estado', '1'],
                    ])
                    ->orWhere([
                        ['dir_foto', 'like', "%$img"],
                        ['estado', '0']
                    ])->first();
            break;
            case 'PUT':
                return Marco::where([
                    ['dir_foto', 'like', "%$img"],
                    ['estado', '1'],
                    ['id_marco','<>', $id],
                    ])
                    ->orWhere([
                        ['dir_foto', 'like', "%$img"],
                        ['estado', '0'],
                        ['id_marco','<>', $id],
                    ])->first();
            break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcoFormRequest $request)
    {              
        /* Version simple - Llamada del create desde el index de marcos */
        // Se obtiene la marca para asociarla con el marco que se esta registrando
        $marca = Marca::findOrFail($request->get('id_marca'));

        // Guardando modelo con el metodo save()
        $marco = new Marco;
        $marco->marca()->associate($marca); // Asociando la marca seleccionada con el marco que se esta ingresando
        
        $marco->fill([
            'cod_marco' => $request->input('cod_marco'),
            'precio' => $request->input('precio'),
            'c_existencia' => $request->input('c_existencia')
        ]);
        
        $archivo = $request->file('dir_foto');
        if($request->hasFile('dir_foto') && $archivo->isValid())
        {           
            if($this->existImage($archivo->getClientOriginalName(), $request))
            {
                return back()
                ->withErrors(['dir_foto' => 'La imagen ya ha sido tomada'])
                ->withInput();
            }  
            $nombreImg = $archivo->getClientOriginalName();
            $path = $archivo->storeAs('imagenes/marcos', $nombreImg, 'public');
            $marco->dir_foto = $nombreImg;
        }
        
        $marco->save();
        
        // dd($request->get('id_tipos_marcos'));
        $marco->tiposmarcos()->sync($request->get('id_tipos_marcos'));

        // dd($marco->tiposmarcos[0]->pivot->id_mtm);

        return redirect()->route("marcos.index");

        /* $marco->precio = ;
        $marco->c_existencia = ; */
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
        $marcas = Marca::where('estado', '1')->get();
        $tiposMarcos = TipoMarco::where('estado', '1')->get();

        $marco = Marco::findOrFail($id);
        foreach($marco->tiposmarcos as $tipoMarco)
        {
            $marcoTipoM[] = $tipoMarco->id_tipo_marco;
        }
        // dd($marcoTipoM);
        return response()->view('adminlentes.marcos.edit', ['marco'=>$marco, 'marcoTipoM' => $marcoTipoM, 'marcas'=>$marcas, 'tiposMarcos'=>$tiposMarcos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarcoFormRequest $request, $id)
    {   
        $marco = Marco::findOrFail($id);
        $marca = Marca::findOrFail($request->get('id_marca'));

        if($request->get('id_marca') !== $marco->id_marca)
            $marco->marca()->associate($marca);

        $marco->fill([
            'cod_marco' => $request->input('cod_marco'),
            'precio' => $request->input('precio'),
            'c_existencia' => $request->input('c_existencia')
        ]);

        $archivo = $request->file('dir_foto');
        if($request->hasFile('dir_foto') && $archivo->isValid() && $archivo->getClientOriginalName() !== $marco->dir_foto)
        {
            if($this->existImage($archivo->getClientOriginalName(), $request, $id))
            {
                return back()
                ->withErrors(['dir_foto' => 'La imagen ya ha sido tomada'])
                ->withInput();
            }
            $nombreImg = $archivo->getClientOriginalName();
            
            Storage::disk('public')->delete('imagenes/marcos/'.$marco->dir_foto);
            
            $path = $archivo->storeAs('imagenes/marcos', $nombreImg, 'public');
            $marco->dir_foto = $nombreImg;
        }

        $marco->tiposmarcos()->sync($request->get('id_tipos_marcos'));
        $marco->save();

        return redirect()->route('marcos.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marco = Marco::findOrFail($id);
        $marco->estado = 0;
        $marco->save();

        return redirect('admin-lentes/marcos');
    }
}
