@extends('layout.master')
@section('parentPageTitle', 'Admin. Usuarios')
@section('title', 'Usuarios')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
{{-- Estilos para Datatable --}}
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<style>

</style>
@stop
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Listado </strong>de Usuarios
                    <span class="d-inline-block pl-3" tabindex="0" data-toggle="tooltip" data-placement="top" title="Registrar Usuario">
                        <a href="usuarios/create" class="btn btn-sm btn-raised btn-success waves-effect waves-light"><i class="zmdi zmdi-account-add"></i></a>
                    </span>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover theme-color mb-0 dataTable" id="datatable">
                        <thead>
                        <tr style="text-align: center" >
                            {{--<th>ID</th>--}}
                            <th>Codigo Minsa</th>
                            <th >Nombre</th>
                            <th>Roles</th>
                            <th style="padding-right: 80px">Opciones</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($usuarios as $cat)
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
                                <td style="text-align: center">
                                    <!-- Mejor forma de poner los tooltips -->
                                   {{-- <span class="d-inline-block " tabindex="0" data-toggle="tooltip" data-placement="top" title="Ver Detalles">
                                    <a href="{{URL::action('OpticaControllers\UsuarioController@show',$cat->id_usuario)}}" class="btn btn-sm btn-neutral btn-raised waves-effect waves-green waves-float"><i class="zmdi zmdi-search"></i></a>
                                </span>--}}

                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Ver Detalles">
                                    <a href="{{URL::action('OpticaControllers\UsuarioController@edit',$cat->id_usuario)}}" class="btn btn-sm btn-neutral btn-raised waves-effect waves-blue waves-float"><i class="zmdi zmdi-search"></i></a>
                                </span>
                                <!-- <a href="" data-target="#modal-delete-{{$cat->id_usuario}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a> -->
                                    <!-- Usando SweetAlert -->
                                    <span class="js-sweetalert d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Dar de Baja">
                                    <a href="{{URL::action('OpticaControllers\UsuarioController@destroy',$cat->id_usuario)}}" class="btn btn-sm btn-neutral btn-raised waves-effect waves-red waves-float"
                                       data-type="confirm"
                                       data-title="Dar de Baja"
                                       data-text="¿Estas seguro en eliminar a {{$cat->nombre}} ?"
                                       data-obj="{{$cat->nombre .' '. $cat->apellido}}"
                                    >
                                         <i class="zmdi zmdi-delete"></i>
                                    </a>
                                </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-script')
    {{-- Scripts para DataTable --}}
    <script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
{{-- Scripts para los botones de jqueryDataTable --}}
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
@stop
@push('after-scripts')
<script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>
    {{-- Scripts para inicializar DataTable --}}
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
@endpush
