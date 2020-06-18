<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Servicio;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ServicioFormRequest;
use Illuminate\Support\Facades\Redirect;

class ServicioController extends Controller
{
    //
    public function index(){
        /*$servicio = new Servicio();
        $servicio = Servicio::where('estado',1)->orderBy('id_servicio','desc')->get();*/
        return view('servicios.index'/*,['servicio'=>$servicio]*/);
    }

    public function getAll(){
        $servicio = Servicio::where('estado',1)->orderBy('id_servicio','desc')->get();
        return response()->json($servicio);
    }

    public function show($id){
        $servicio = DB::table('servicio')->where('id_servicio','=',$id)->get();
        return view("servicios.show",["servicio" => Servicio::findOrFail($id)]);
    }

    public function edit($id){
        $servicio = Servicio::where('id_servicio',$id)->get();
        /*return view("servicios.edit",["servicio" => Servicio::findOrFail($id)]);*/
        return response()->json($servicio);
    }

    public function create(){
        return view("servicios.create");
    }

    public function store(ServicioFormRequest $request){
       /* try{
            DB::beginTransaction();*/
            $servicio = new Servicio;
            $servicio->servicio = $request->get('servicio');
            $servicio->precio = $request->get('precio');
            $servicio->save();
       /*     DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }*/
        return Redirect::to('servicios');
    }

    public function update(ServicioFormRequest $request,$id){
        try{
            DB::beginTransaction();
            $servicio = Servicio::findOrFail($id);
            $servicio->servicio = $request->get('servicio');
            $servicio->precio= $request->get('precio');
            $servicio->update();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }
        return Redirect::to('servicios');
    }

    public function destroy($id){
        $servicio = Servicio::findOrFail($id);
        $servicio->estado = '0';
        $servicio->update();
        return Redirect::to('servicios');
    }
}
