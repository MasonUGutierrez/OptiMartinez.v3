@extends('layout.master')
@section('parentPageTitle', 'Historia Clinica')
@section('title', 'Detalles')

@section('page-style')
{{-- Estilos para el sweetalert --}}
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}">
{{-- Estilos para la jQuery DataTable --}}
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>
                    <strong>Detalles</strong> Historia Clinica
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Editar">
                        <a href="#" class="btn btn-raised btn-sm btn-primary waves-effect waves-light">
                            <i class="zmdi zmdi-edit"></i>
                        </a>
                    </span>
                </h2>
            </div>
            <div class="body">

            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>
                    <strong>Listado</strong> Consultas
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Registrar Consulta">
                        <a href="#" class="btn btn-raised btn-sm btn-success waves-effect waves-light">
                            <i class="zmdi zmdi-plus"></i>
                        </a>
                    </span>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive-md">
                    <table class="table table-hover table-bordered theme-color dataTable">
                        <caption>Lista de consultas</caption>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
{{-- Script para el sweetalert --}}
<script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
{{-- Script para la jQuery DataTable --}}
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
{{-- Script para los  botones de jQuery DataTable --}}
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
@endsection
@push('after-scripts')
{{-- Script para inicializar el sweetalert --}}
<script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>
{{-- Script para inicializar el jQuery DataTable --}}
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
@endpush
