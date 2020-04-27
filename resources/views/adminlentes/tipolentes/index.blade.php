@extends('layout.master')
@section('parentPageTitle', 'Admin. Lentes')
@section('title', 'Tipos de Lentes')

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
                <h2><strong>Listado</strong> Tipos de Lentes
                    <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Agregar Tipo de Lente">
                        <a href="{{action('OpticaControllers\TipoLenteController@create')}}" class="btn btn-success btn-sm btn-raised waves-effect waves-float waves-light">
                            <i class="zmdi zmdi-plus"></i>
                        </a>
                    </span>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover tb-responsive theme-color dataTable">
                        <thead>
                            <tr>
                                <th>Tipo de Lente</th>
                                <th>Precio Base (C$)</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tiposLentes as $tipoLente)
                                <tr class="{{$tipoLente->estado == '0' ? 'table-active' : ''}}">
                                    <td>{{$tipoLente->tipo_lente}}</td>
                                    <td>{{$tipoLente->precio}}</td>
                                    @if($tipoLente->estado == 1)
                                        <td><span class="badge badge-success">Activo</span></td>
                                    @else
                                        <td><span class="badge badge-danger">Inactivo</span></td>
                                    @endif
                                    <td>
                                        <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Editar">
                                            <a href="{{action('OpticaControllers\TipoLenteController@edit',$tipoLente->id_tipo_lente)}}" 
                                                {{$tipoLente->estado == '0' ? 'disabled style=pointer-events:none;cursor:default;' : ''}} 
                                                class="btn btn-neutral btn-raised btn-sm waves-effect waves-float waves-blue">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                        </span>
                                        @if($tipoLente->estado == 1)   
                                            <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Dar de Baja">
                                                <a href="{{action('OpticaControllers\TipoLenteController@destroy', $tipoLente->id_tipo_lente)}}" class="btn btn-neutral btn-raised btn-sm waves-effect waves-float waves-red"
                                                    data-type="confirm"
                                                    data-text="Se dará de baja el tipo de lente {{'"'.$tipoLente->tipo_lente.'"'}}"
                                                    data-obj="Tipo de lente {{'"'.$tipoLente->tipo_lente.'"'}}">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>
                                            </span>
                                        @else
                                            <span class="d-inline-block js-sweetalert" data-toggle="tooltip" tabindex="0" title="Reactivar">
                                                <a href="{{route('tipos-lentes.reactivar', $tipoLente->id_tipo_lente {{--['tipo_lente' => $tipoLente->id_tipo_lente]--}})}}" class="btn btn-neutral btn-raised btn-sm waves-effect waves-float waves-green" 
                                                    data-type="reactivar"
                                                    data-obj="Tipo de Lente {{'"'.$tipoLente->tipo_lente.'"'}}">
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