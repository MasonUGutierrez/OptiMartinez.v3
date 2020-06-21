@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/multi-select/css/multi-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-spinner/css/bootstrap-spinner.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
    {{-- Script para SweetAlert --}}
    <script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
    {{-- Estilos para Datatable --}}
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
    {{-- Estilos para SweetAlert --}}
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}">
    <style>
        .input-group-text {
            padding: 0 .75rem;
        }
    </style>
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Listado</strong> de Roles</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dataTable-rol theme-color mb-0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th style="text-align: center">Nombre del Rol</th>
                                <th style="text-align: center">Opciones</th>
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
    @include('roles.modal-detail')
    @include('roles.modal-assign')
@endsection
@section('page-script')
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
    <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
  {{--  <script src="{{asset('assets/plugins/multi-select/js/jquery.multi-select.js')}}"></script>--}}
    <script src="{{asset('assets/js/js_propios/js_roles/script.js')}}"></script>
    {{-- Scripts para inicializar DataTable --}}
   {{-- <script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>--}}
@endpush
