<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolFormRequest;
use Illuminate\Http\Request;
use App\Usuario;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use DB;

class RolController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index(){
        $rol=DB::table('rol')->get()->where('estado','=','1');
        return view('roles.index',['rol'=>rol]);
    }

    public function create(){
        return view("roles.create");
    }

    public function store(RolFormRequest $request){
        $rol = new Rol;
        $rol->rol=$request->get('rol');
        $rol->save();
        return Redirect::to('roles');
    }

    public function show($id){
        return view("rol.show",["rol"=>Rol::findOrFail($id)]);
    }

    public function edit($id){
        return view("rol.edit",["rol"=>Rol::findOrFail($id)]);
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
