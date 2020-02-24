<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Usuario;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use DB;

class UsuarioController extends Controller
{
    //
    public function __construct(){
    }
    /*public function index (Request $request){*/
    public function index (){
        // if($request){
        //     $query=trim($request->get('searchText'));
        //     $usuario=DB::table('usuario')->where('nombre','LIKE','%'.$query.'%')
        //     ->orderBy('id_usuario','desc')
        //     ->paginate(7);
        //     return view('inicio.usuarios.index',["usuario"=>$usuario,"searchText"=>$query]);
        // }
        $usuario=DB::table('usuario')->get()->where('estado','=','1');

        return view('usuarios.index',["usuario"=>$usuario]);
    }

    public function detalle(){
        return view("usuarios.detalle");
    }

    public function create(){
        return view("usuarios.create");
    }
    public function store(UsuarioFormRequest $request){
        $usuario = new Usuario;
        $usuario->cod_minsa=$request->get('cod_minsa');
        $usuario->nombre=$request->get('nombre');
        $usuario->apellido=$request->get('apellido');
        $usuario->cedula=$request->get('cedula');
        $usuario->telefono=$request->get('telefono');
        $usuario->correo=$request->get('correo');
        $usuario->dir_foto=$request->get('dir_foto');
        $usuario->contraseña=$request->get('contraseña');
        $usuario->descripcion=$request->get('descripcion');
        /*****************************************************************************************************/
        // Comentado porque no es necesario esta por default que cuando se guarde un registro que le ponga 1
        //$usuario->estado='1';
        /*****************************************************************************************************/
        $usuario->save();
        return Redirect::to('usuarios');
    }
    public function show($id){
        return view("usuarios.show",["usuario"=>Usuario::findOrFail($id)]);
    }
    public function edit($id){
        return view("usuarios.edit",["usuario"=>Usuario::findOrFail($id)]);
    }
    public function update(UsuarioFormRequest $request,$id){
        $usuario = Usuario::findOrFail($id);
        $usuario->cod_minsa=$request->get('cod_minsa');
        $usuario->nombre=$request->get('nombre');
        $usuario->apellido=$request->get('apellido');
        $usuario->cedula=$request->get('cedula');
        $usuario->telefono=$request->get('telefono');
        $usuario->correo=$request->get('correo');
        $usuario->dir_foto=$request->get('dir_foto');
        $usuario->contraseña=$request->get('contraseña');
        $usuario->descripcion=$request->get('descripcion');
        $usuario->update();
        return Redirect::to('usuarios');
    }
    public function destroy($id){

        $usuario= Usuario::findOrFail($id);
        $usuario->estado='0';
        $usuario->update();
        return Redirect::to('usuarios');


    }
}
