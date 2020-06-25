<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Servicio;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ServicioFormRequest;
use Illuminate\Support\Facades\Redirect;
use DataTables;
class ServicioController extends Controller
{
    //
    public function index(){
        /*$servicio = new Servicio();
        $servicio = Servicio::where('estado',1)->orderBy('id_servicio','desc')->get();*/
        return view('servicios.index'/*,['servicio'=>$servicio]*/);
    }

    public function getAll(Request $request){
        $servicio = Servicio::where('estado',1)->get();
        if($request->ajax()){
            return DataTables::of($servicio)
                ->addIndexColumn()
                ->addColumn('opciones', function($row){
                    $btns = '
                    <div style="text-align:center">
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Editar" data-original-title="Editar">
                            <a href="servicios/'.$row->id_servicio.'/edit" data-target=".servicioAsignar" data-toggle="modal"  onclick="editData('.$row->id_servicio.')" class="btn btn-sm btn-neutral btn-raised waves-effect waves-blue waves-float">Detalles
                            </a>
                        </span>
                       <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Dar de Baja" data-original-title="Dar de Baja">
                            <a href="#" onclick="deleteData('.$row->id_servicio.')"  class="btn btn-sm btn-neutral btn-raised waves-effect darBaja waves-red waves-float"
                                  data-type="confirm"
                                  data-title="Dar de Baja"
                                  data-text="Se dara de baja el servicio ' . $row->servicio . '"
                                  data-obj="Servicio ' . $row->id_servicio . '">
                                  <i class="zmdi zmdi-delete"></i>
                            </a>
                       </span>';

                    return $btns;
                })
                ->rawColumns(['opciones'])
                ->make(true);
        }
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
