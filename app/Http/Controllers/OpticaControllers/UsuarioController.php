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
        // Buscar solucion para la paginacion
        // $usuario = DB::table('usuario')/*->get()*/->where('estado', '=', '1')
        // ->orderBy('id_usuario','desc')
        // ->paginate(10);

        $usuarios = Usuario::where('estado','1')->orderBy('id_usuario','desc')->get();

        return view('usuarios.index', ['usuarios'=>$usuarios]);
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
            $usuario->ccontraseña = $request->get('ccontraseña');
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
        $rol = new Rol();

        $rol = DB::table('rol')->get()->where('estado', '=', '1');
        $usuario_roles = DB::table('usuario-rol')->select('id_rol')->where('id_usuario', '=', $id)->where('estado', '=', '1')->get();
        $valores = [];
        foreach ($usuario_roles as $uroles) {
            $valores[] = $uroles->id_rol;
        }
        return view("usuarios.show", ["usuario" => Usuario::findOrFail($id), "rol" => $rol, "valores" => $valores]);
    }

    public function edit($id)
    {
        // Estas sentencias son ambiguas, creas un objeto en base al modelo y despues el objeto recibe lo que retorna la query
        // $rol = new Rol();
        // $rol = DB::table('rol')->get()->where('estado', '=', '1');

        // Ocupando Eloquent para resumir lo de arriba
        $rol = Rol::where('estado','1')->get();

        // Se obtiene los roles del usuario con id = $id
        // $usuario_roles = DB::table('usuario-rol')->select('id_rol')->where('id_usuario','=',$id)->where('estado', '=', '1')->get();
        $usuario = Usuario::findOrFail($id);

        // print_r($usuario->roles[0]->rol);

        // Arreglo para solo los id de los roles, se van ocupar para la funcion in_array en la view
        $valores = [];

        foreach ($usuario->roles as $uroles){
            $valores[] = $uroles->id_rol;
        }

        //Para enviar varios objetos a la vistas encerrarlos todos como un arreglo asociativo
        return view("usuarios.edit", ["usuario" => $usuario,"rol" => $rol,"valores"=>$valores]);
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
                $usuario->ccontraseña = $request->get('ccontraseña');
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
                        $cont++;
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
