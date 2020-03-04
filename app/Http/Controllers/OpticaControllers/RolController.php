<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolFormRequest;
use App\Http\Requests\Usuario_RolFormRequest;
use Illuminate\Http\Request;
use App\Rol;
use App\Usuario_Rol;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;

class RolController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index(){
        $rol=DB::table('rol')->get()->where('estado','=','1');

        $usuario=DB::table('usuario')->get()->where('estado','=','1');

      /*  $usuario=DB::select('call usuarios_roles(?)',array($p1));*/ //Investigar como hacer esto


        $usuariorol=DB::table('usuario-rol')->get()->where('estado','=',1);
        return view('roles.index',['rol'=>$rol],['usuario'=>$usuario]);
    }

    //Mostrar los nombres de usuarios mientras, el id rol de usuariorol sea diferente del rol

    public function create(){
        return view("roles.create");
    }

    public function store(Usuario_RolFormRequest $request){

        $usuariorol = new Usuario_Rol;
        $usuariorol->id_usuario=$request->get('id_usuario');
        $usuariorol->id_rol=$request->get('id_rol');
        $usuariorol->save();
        return Redirect::to('roles');
    }

    public function show($id){
        return view("rol.show",["rol"=>Rol::findOrFail($id)]);
    }

    public function edit($id){
        return view("roles.asignar",["rol"=>Rol::findOrFail($id)]);
    }

    public function asignar($id){
        /*$usuario=DB::table('usuario')->get()->where('estado','=','1');*/
        $usuario=DB::select('call usuarios_roles(?)',array($id));

        return view("roles.asignar",["rol"=>Rol::findOrFail($id)],["usuario"=>$usuario]);
    }

    public function update(RolFormRequest $request,$id){
        $rol = Rol::findOrFail($id);
        $rol->rol=$request->get('rol');
        $rol->update();
        return Redirect::to('roles');
    }

    public function destroy($id){
        $rol=Rol::findOrFail($id);
        $rol->estado='0';
        $rol->update();
        return Redirect::to('roles');
    }

}
