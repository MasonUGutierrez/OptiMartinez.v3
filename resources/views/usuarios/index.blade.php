@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-spinner/css/bootstrap-spinner.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
<style>

</style>
@stop
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h3><strong>Listado de Usuarios</strong><span class="d-inline-block pl-3" tabindex="0" data-toggle="tooltip" data-placement="top" title="Nuevo Usuario">
                                        <a href="usuarios/create" class="btn btn-raised btn-success waves-effect"><b class="zmdi zmdi-account-add"></b></a>
                                    </span></h3>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover product_item_list c_table theme-color mb-0" id="datatable">
                        <thead>
                        <tr style="text-align: center">
                            {{--<th>ID</th>--}}
                            <th>Codigo Minsa</th>
                            <th >Nombre</th>
                            <th>Roles</th>
                            <th style="padding-right: 80px">Opciones</th>
                        </tr>
                        </thead>

                        @foreach($usuarios as $cat)
                            <tbody>
                            <tr>
                                <td style="text-align: center">{{$cat->cod_minsa}}</td>
                                <td>{{$cat->nombre}} {{$cat->apellido}}</td>
                                <td>
                                    @foreach($cat->roles as $roles)
                                    <!-- Operador ternario anidados necesitan parentesis para las demas condiciones -->
                                        <span class="badge badge-{{($roles->rol == 'Administrador') ? 'primary' :
                                                                   (($roles->rol == 'Tesorero') ? 'success' :
                                                                   (($roles->rol == 'Optometrista') ? 'warning' :
                                                                   (($roles->rol == 'Recepcionista') ? 'default' : 'danger')))}}">{{$roles->rol}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <!-- Mejor forma de poner los tooltips -->
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Ver Detalles">
                                        <a href="{{URL::action('OpticaControllers\UsuarioController@show',$cat->id_usuario)}}" class="btn btn-raised btn-secondary waves-effect"><i class="ti-search"></i></a>
                                    </span>

                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <a href="{{URL::action('OpticaControllers\UsuarioController@edit',$cat->id_usuario)}}" class="btn btn-raised btn-info waves-effect"><i class="ti-pencil-alt"></i></a>
                                    </span>
                                    <!-- <a href="" data-target="#modal-delete-{{$cat->id_usuario}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a> -->
                                    <!-- Usando SweetAlert -->
                                    <span class="js-sweetalert d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Dar de Baja">
                                        <a href="{{URL::action('OpticaControllers\UsuarioController@destroy',$cat->id_usuario)}}" class="btn btn-raised btn-danger waves-effect"
                                            data-type="confirm"
                                            data-title="Dar de Baja"
                                            data-text="¿Estas seguro en eliminar a {{$cat->nombre}} ?"
                                            data-obj="{{$cat->nombre .' '. $cat->apellido}}"
                                        >
                                            <i class="ti-trash"></i>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#datatable').DataTable();
</script>
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
