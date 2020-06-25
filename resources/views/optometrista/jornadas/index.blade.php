@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
    {{-- Estilos para Datatable --}}
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@stop
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Listado de<strong> Jornadas</strong>
                    <span class="d-inline-block pl-3" tabindex="0" data-toggle="tooltip" data-placement="top" title="Nueva Jornada">
                        <a href="#" data-toggle="modal" onclick="activarSelect()" data-target=".newJornada" class="btn btn-raised btn-success waves-effect waves-light"><i class="zmdi zmdi-gps-dot"></i></a>
                    </span>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover dataTable-jornada theme-color mb-0">
                        <thead>
                        <tr style="text-align: center">
                            <th>Nombre</th>
                            <th style="text-align: center">Tipo</th>
                            <th style="text-align: center">Fecha</th>
                            <th>Lugar</th>
                            <th>Departamento</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>

                        <tbody id="tabla">
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('optometrista.jornadas.add-jornada')
@include('optometrista.jornadas.edit-jornada')
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    {{-- Scripts para DataTable --}}
    <script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
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
{{--
    <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
--}}
    <script src="{{asset('assets/js/js_propios/js_optometrista/js_jornada/script.js')}}"></script>
@endpush
