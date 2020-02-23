@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h3><strong>Listado de Usuarios</strong> <a href="usuarios/create"><button class="btn btn-success">Nuevo</button></a></h3>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover product_item_list c_table theme-color mb-0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Codigo Minsa</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Cédula</th>
                            <th>Telefono</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>

                        @foreach($usuario as $cat)
                            <tbody>
                            <tr>
                                <td>{{$cat->id_usuario}}</td>
                                <td>{{$cat->cod_minsa}}</td>
                                <td>{{$cat->nombre}}</td>
                                <td>{{$cat->apellido}}</td>
                                <td>{{$cat->cedula}}</td>
                                <td>{{$cat->telefono}}</td>
                                <td>
                                    <a href=""><button class="btn btn-secondary">Detalles</button></a>
                                    <a href="{{URL::action('OpticaControllers\UsuarioController@edit',$cat->id_usuario)}}"><button class="btn btn-info">Editar</button></a>
                                    <a href=""><button class="btn btn-danger">Eliminar</button></a>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
        <div class="card">
            <div class="body">
                <ul class="pagination pagination-primary m-b-0">
                    <li class="page-item"><a class="page-link" href="javascript:void(0);"><i class="zmdi zmdi-arrow-left"></i></a></li>
                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);"><i class="zmdi zmdi-arrow-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection