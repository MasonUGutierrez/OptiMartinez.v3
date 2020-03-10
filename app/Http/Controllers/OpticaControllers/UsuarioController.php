<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Usuario;
use App\Rol;
use App\Usuario_Rol;
/*use Illuminate\Support\Facades\Request;*/

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use DB;

class UsuarioController extends Controller
{
    //
    public function __construct()
    {
    }

    /*public function index (Request $request){*/
    public function index()
    {
        $usuario = DB::table('usuario')/*->get()*/->where('estado', '=', '1')
        ->orderBy('id_usuario','desc')
        ->paginate(10);

        return view('usuarios.index', ["usuario" => $usuario]);
    }

    public function detalle()
    {
        return view("usuarios.detalle");
    }

    public function create()
    {
        $rol = new Rol();
        $rol = DB::table('rol')->get()->where('estado', '=', '1');
        return view("usuarios.create", ["rol" => $rol]);
    }

    public function store(UsuarioFormRequest $request)
    {

        try {
            DB::beginTransaction();
            $usuario = new Usuario;
            $usuario->cod_minsa = $request->get('cod_minsa');
            $usuario->nombre = $request->get('nombre');
            $usuario->apellido = $request->get('apellido');
            $usuario->cedula = $request->get('cedula');
            $usuario->telefono = $request->get('telefono');
            $usuario->correo = $request->get('correo');
            $entrada = $request->all();
            if ($archivo = $request->file('dir_foto')) {
                $nombre = $archivo->getClientOriginalName();
                $archivo->move('imagenes/usuarios', $nombre);
                $entrada['dir_foto'] = $nombre;
                $usuario->dir_foto = $entrada['dir_foto'];
            }
            $usuario->contraseña = $request->get('contraseña');
            $usuario->descripcion = $request->get('descripcion');
            $usuario->save();

            $idroles = $request->get('id_roles');

            $cont = 0;
            while ($cont < count($idroles)) {
                $rolerinos = new Usuario_Rol();
                $rolerinos->id_usuario = $usuario->id_usuario;
                $rolerinos->id_rol = $idroles[$cont];
                $rolerinos->save();
                $cont = $cont + 1;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return Redirect::to('usuarios');
    }

    public function show($id)
    {
        return view("usuarios.show", ["usuario" => Usuario::findOrFail($id)]);
    }

    public function edit($id)
    {
        $rol = new Rol();
        $rol = DB::table('rol')->get()->where('estado', '=', '1');
        $usuario_roles = DB::table('usuario_rol')->select('id_rol')->where('id_usuario','=',$id)->where('estado', '=', '1')->get();
        $valores = [];
        /*print_r($usuario_roles);*/
        foreach ($usuario_roles as $uroles){
            $valores[]=$uroles->id_rol;
        }
        //El array_push es una funcion
        //Para enviar varios objetos a la vistas encerrarlos todos como un arreglo asociativo
        return view("usuarios.edit", ["usuario" => Usuario::findOrFail($id),"rol" => $rol,"valores"=>$valores]);
    }

    public function update(UsuarioFormRequest $request, $id)
    {
            try{
                DB::beginTransaction();
                $usuario = Usuario::findOrFail($id);
                $usuario->cod_minsa = $request->get('cod_minsa');
                $usuario->nombre = $request->get('nombre');
                $usuario->apellido = $request->get('apellido');
                $usuario->cedula = $request->get('cedula');
                $usuario->telefono = $request->get('telefono');
                $usuario->correo = $request->get('correo');
                $entrada = $request->all();
                if ($archivo = $request->file('dir_foto')) {
                    $nombre = $archivo->getClientOriginalName();
                    $archivo->move('imagenes/usuarios', $nombre);
                    $entrada['dir_foto'] = $nombre;
                    $usuario->dir_foto = $entrada['dir_foto'];
                }
                $usuario->contraseña = $request->get('contraseña');
                $usuario->descripcion = $request->get('descripcion');
                $usuario->update();

                DB::select('call borrar_asignacion(?)',array($id));
                $idroles = $request->get('id_roles');
                $cont = 0;
                 while ($cont < count($idroles)) {
                        $rolerinos = new Usuario_Rol();
                        $rolerinos->id_usuario = $usuario->id_usuario;
                        $rolerinos->id_rol = $idroles[$cont];
                        $rolerinos->save();
                        $cont = $cont + 1;
                 }
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
            }



        return Redirect::to('usuarios');
    }

    public function destroy($id)
    {

        $usuario = Usuario::findOrFail($id);
        $usuario->estado = '0';
        $usuario->update();
        return Redirect::to('usuarios');
    }
}
