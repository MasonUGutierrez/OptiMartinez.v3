@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Materiales')

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
                <h2><strong>Listado</strong> de Materiales
                    <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Agregar Material">
                        <a href="{{action('OpticaControllers\TipoMaterialController@create')}}" 
                            class="btn btn-success btn-sm btn-raised waves-float waves-effect waves-light">
                            <i class="zmdi zmdi-plus"></i>
                        </a>
                    </span>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered theme-color dataTable">
                        <thead>
                            <tr>
                                <td>Material</td>
                                <td>Precio Base (C$)</td>
                                <td>Estado</td>
                                <td>Opciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tiposMateriales as $tipoMaterial)
                                <tr class="{{$tipoMaterial->estado == '0' ?'table-active':''}}">
                                    {{-- Campos --}}
                                    <td>{{$tipoMaterial->tipo_material}}</td>
                                    <td>{{$tipoMaterial->precio}}</td>
                                    <td>
                                        @if($tipoMaterial->estado == 1)
                                            <span class="badge badge-success">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    {{-- Opciones --}}
                                    <td>
                                        <span class="d-inline-block " data-toggle="tooltip" tabindex="0" title="Editar">
                                            <a href="{{action('OpticaControllers\TipoMaterialController@edit', $tipoMaterial->id_tipo_material)}}"
                                                class="btn btn-sm btn-raised btn-neutral waves-float waves-effect waves-blue"
                                                {{$tipoMaterial->estado == '0'?'disabled style=cursor:default;pointer-events:none;':''}}>
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                        </span>
                                        @if($tipoMaterial->estado == 1)
                                            <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Dar de Baja">
                                                <a href="{{action('OpticaControllers\TipoMaterialController@destroy', $tipoMaterial->id_tipo_material)}}"
                                                    class="btn btn-sm btn-raised btn-neutral waves-float waves-effect waves-red"
                                                    data-type="confirm"
                                                    data-text="Se dará de baja el material {{'"'.$tipoMaterial->tipo_material.'"'}}"
                                                    data-obj="Material {{'"'.$tipoMaterial->tipo_material.'"'}}">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>
                                            </span>
                                        @else
                                            <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Reactivar">
                                                <a href="{{route('materiales.reactivar', $tipoMaterial->id_tipo_material)}}"
                                                    class="btn btn-sm btn-raised btn-neutral waves-float waves-effect waves-green"
                                                    data-type="reactivar"
                                                    data-obj="Material {{'"'.$tipoMaterial->tipo_material.'"'}}">
                                                    <i class="zmdi zmdi-check"></i>
                                                </a>
                                            </span>
                                        @endif
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
{{-- Scripts para el Sweetalert --}}
<script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>

{{-- Scripts para la jqueryDataTable --}}
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>

{{-- Scripts para los botones de jqueryDataTable --}}
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
@endsection

@push('after-scripts')
<script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
@endpush