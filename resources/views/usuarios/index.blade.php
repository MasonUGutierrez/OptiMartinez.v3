@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/morrisjs/morris.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/multi-select/css/multi-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-spinner/css/bootstrap-spinner.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/nouislider/nouislider.min.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
@stop
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
                        <tr style="text-align: center">
                            {{--<th>ID</th>--}}
                            <th>Codigo Minsa</th>
                            <th >Nombre</th>
                            <th>Cédula</th>
                            <th>Telefono</th>
                            <th>Imagen</th>
                            <th >Opciones</th>
                            
                        </tr>
                        </thead>

                        @foreach($usuario as $cat)
                            <tbody>
                            <tr>
                                {{--<td>{{$cat->id_usuario}}</td>--}}
                                <td style="text-align: center">{{$cat->cod_minsa}}</td>
                                <td>{{$cat->nombre}} {{$cat->apellido}}</td>
                                <td>{{$cat->cedula}}</td>
                                <td>{{$cat->telefono}}</td>

                                <td><img src="imagenes/usuarios/{{$cat->dir_foto}}" width="50" alt="img"></td>
                                <td>
                                    <a href="{{URL::action('OpticaControllers\UsuarioController@show',$cat->id_usuario)}}" class="btn btn-secondary">Detalles</a>
                                    <a href="{{URL::action('OpticaControllers\UsuarioController@edit',$cat->id_usuario)}}" class="btn btn-info">Editar</a>

                                    <!-- <a href="" data-target="#modal-delete-{{$cat->id_usuario}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a> -->
                                    <!-- Usando SweetAlert -->
                                    <span class="js-sweetalert">
                                        <a href="{{URL::action('OpticaControllers\UsuarioController@destroy',$cat->id_usuario)}}" class="btn btn-raised btn-danger waves-effect"
                                        data-type="confirm"
                                        data-title="Dar de Baja"
                                        data-text="¿Estas seguro en eliminar a {{$cat->nombre}} ?"
                                        data-obj="{{$cat->nombre .' '. $cat->apellido}}">Eliminar</a>
                                    </span>                                   
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            {{$usuario->render()}}
        </div>
        {{--<div class="card">
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
        </div>--}}
    </div>
</div>
@endsection
@section('page-script')
<script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@stop