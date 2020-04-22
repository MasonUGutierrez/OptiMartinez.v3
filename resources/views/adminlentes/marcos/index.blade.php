@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Marcos')

@section('page-style')
{{-- Estilos para el Sweetalert --}}
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}">
{{-- Estilos para la jqueryDataTable --}}
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Listado </strong>de Marcos <span id="estado"></span>
                    <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Agregar Nuevo Marco">
                        <a href="{{action('OpticaControllers\MarcoController@create')}}" 
                            class="btn btn-success btn-sm btn-raised waves-float waves-effect waves-light">
                            <i class="zmdi zmdi-plus"></i>
                        </a>
                    </span>
                </h2>
            </div>
            <div class="card">
                <div class="body">
                    <ul class="nav nav-tabs p-0">
                        <li class="nav-item">
                            <a href="#activos" id="btn-activos" class="nav-link active" data-toggle="tab">Activos</a>
                        </li>
                        <li class="nav-item">
                            <a href="#inactivos" id="btn-inactivos" class="nav-link" data-toggle="tab">Inactivos</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="body">
                    <div class="tab-content">
                        {{-- Listado de Marcos Activos --}}
                        <div role="tabpanel" class="tab-pane in active" id="activos">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered theme-color dataTable">
                                    <thead>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Marca</th>
                                            <th>Cod. Marco</th>
                                            <th>Existencia</th>
                                            <th>Precio (C$)</th>
                                            <th>Tipo de Marco</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($marcos_activos as $mActivo)
                                            <tr>
                                                <td class="text-center">
                                                    <img src="{{asset('storage/imagenes/marcos/'.$mActivo->dir_foto)}}" alt="img-marco" width="48" height="48">
                                                </td>
                                                <td>{{$mActivo->marca->marca}}</td>
                                                <td>{{$mActivo->cod_marco}}</td>
                                                <td>{{$mActivo->c_existencia}}</td>
                                                <td>{{$mActivo->precio}}</td>
                                                <td>
                                                    @foreach($mActivo->tiposmarcos as $tipoMarco)
                                                        <span class="badge badge-primary">{{$tipoMarco->tipo_marco}}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Editar">
                                                        <a href=""
                                                            class="btn btn-neutral btn-sm btn-raised waves-effect waves-float waves-blue">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                    </span>
                                                    <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Dar de Baja">
                                                        <a href=""
                                                            class="btn btn-neutral btn-sm btn-raised waves-effect waves-float waves-red"
                                                            data-type="confirm"
                                                            data-text="Se dará de baja el marco {{'"'.$mActivo->cod_marco.'"'}}"
                                                            data-obj="Marco {{'"'.$mActivo->cod_marco.'"'}}">
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
                        {{-- Listado de Marcos Inactivos --}}
                        <div role="tabpanel" class="tab-pane " id="inactivos">
                            <div class="table-responsive theme-red">
                                <table class="table table-hover table-bordered theme-color dataTable">
                                    <thead>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Marca</th>
                                            <th>Cod. Marco</th>
                                            <th>Existencia</th>
                                            <th>Precio (C$)</th>
                                            <th>Tipos de Marco</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($marcos_inactivos as $mInactivo)
                                            <tr>
                                                <td class="text-center">
                                                    <img src="{{asset('storage/imagenes/marcos/'.$mInactivo->dir_foto)}}" alt="img-marco" width="48" height="48">
                                                </td>
                                                <td>{{$mInactivo->marca->marca}}</td>
                                                <td>{{$mInactivo->cod_marco}}</td>
                                                <td>{{$mInactivo->c_existencia}}</td>
                                                <td>{{$mInactivo->precio}}</td>
                                                <td>
                                                    @foreach($mActivo->tiposmarcos as $tipoMarco)
                                                        <span class="badge badge-danger">{{$tipoMarco->tipo_marco}}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Reactivar">
                                                        <a href=""
                                                            class="btn btn-neutral btn-sm btn-raised waves-effect waves-float waves-green"
                                                            data-type="reactivar"
                                                            data-obj="Marco {{'"'.$mInactivo->cod_marco.'"'}}">
                                                            <i class="zmdi zmdi-check"></i>
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
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script>
    $(function(){
        if($('#activos').hasClass('active'))
            $('#estado').text('Activos');

        $('#btn-activos').on('click', function(){
            $('#estado').text('Activos');
        });
        $('#btn-inactivos').on('click', function(){
            $('#estado').html('Inactivos');
        });
    });
</script>
{{-- Script para el Sweetalert --}}
<script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>

{{-- Script para la jqueryDataTable --}}
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>

{{-- Script para los botones de la jqueryDataTable --}}
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
@endsection
