<?php

namespace App\Http\Controllers\OpticaControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolFormRequest;
use App\Http\Requests\Usuario_RolFormRequest;

use DataTables;
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

    public function index()
    {
        /* $rol=DB::table('rol')->get()->where('estado','=','1');*/
        return view('roles.index'/*,['rol'=>$rol]*/);
    }

    public function getAll(Request $request)
    {
        $rol = Rol::where('estado', '1')->get();
        if ($request->ajax()) {
            return DataTables::of($rol)
                ->addIndexColumn()
                ->addColumn('opciones', function ($row) {
                    $btns = '
                    <div style="text-align:center">
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ver detalles" data-original-title="Editar">
                            <a href="" data-toggle="modal" data-target="#largeModal" onclick="showUserRol(' . $row->id_rol . ')" class="btn btn-sm btn-neutral btn-raised waves-effect waves-blue waves-float">
                            <i class="zmdi zmdi-search"></i>
                            </a>
                        </span>
                        <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Asignar Usuario" data-original-title="Asignar Usuario">
                            <a href="" data-toggle="modal" data-target=".assign-modal" onclick="assignRol(' . $row->id_rol . ')" class="btn btn-sm btn-neutral btn-raised waves-effect darBaja waves-red waves-float">
                            <i class="zmdi zmdi-assignment-returned"></i>
                            </a>
                        </span>
                        </div>';

                    return $btns;
                })
                ->rawColumns(['opciones'])
                ->make(true);
        }
        return response()->json($rol);
    }

    //Mostrar los nombres de usuarios mientras, el id rol de usuariorol sea diferente del rol
    public function create()
    {
        return view("roles.create");
    }

    public function store(Usuario_RolFormRequest $request)
    {
        try {
            DB::beginTransaction();
            $ids = $request->get('id_usuario');
            $cont = 0;
            while ($cont < count($ids)) {
                $usuariorol = new Usuario_Rol;
                $usuariorol->id_usuario = $ids[$cont];
                $usuariorol->id_rol = $request->get('id_rol');
                $usuariorol->save();
                $cont = $cont + 1;
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return Redirect::to('roles');
    }

    public function show(Request $request, $id)
    {
        $idrol = $id;
        $usuario = DB::select('call roles_usuarios(?)', array($id));
        if ($request->ajax()) {
            return DataTables::of($usuario)
                ->addIndexColumn()
                ->addColumn('opciones', function ($row) use ($idrol) {
                    $btns = '
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Remover Rol" data-original-title="Editar">
                                    <a href="byeRol/'.$row->id_usuario.'/'.$idrol.'" class="btn btn-sm btn-neutral btn-raised waves-effect waves-blue waves-float">
                                       <i class="zmdi zmdi-delete"></i>
                                    </a>
                               </span>

                             ';

                    return $btns;
                })
                ->addColumn("NombreCompleto", function ($row) {
                    return $row->nombre . " " . $row->apellido;
                })
                ->rawColumns(['opciones','NombreCompleto'])
                ->make(true);
        }

        return response()->json($usuario);
    }

    public function edit($id)
    {
        return view("roles.asignar", ["rol" => Rol::findOrFail($id)]);
    }

    public function asignar(Request $request, $id)
    {
        $usuario = DB::select('call usuarios_roles(?)', array($id));
        return response()->json($usuario);
    }

    public function update(RolFormRequest $request, $id)
    {
        $rol = Rol::findOrFail($id);
        $rol->rol = $request->get('rol');
        $rol->update();
        return Redirect::to('roles');
    }

    public function destroy($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->estado = '0';
        $rol->update();
        return Redirect::to('roles');
    }
}
