@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
@stop
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Listado </strong>de Consultas
                    <span class="d-inline-block pl-3" tabindex="0" data-toggle="tooltip" data-placement="top" title="Nueva Consulta">
                        <a href="#" data-toggle="modal" onclick="verJornada()" data-target=".newConsulta" class="btn btn-raised btn-success waves-effect waves-light"><i class="zmdi zmdi-assignment"></i></a>
                    </span>
                </h2>
            </div>
            <div class="body">
                <table class="table table-hover product_item_list c_table theme-color mb-0">
                    <thead>
                    <tr style="text-align: center">
                        <th>#</th>
                        <th>Nombre de la Jornada</th>
                        <th style="text-align: center">Fecha</th>
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
@include('optometrista.consulta.add-consulta')
@include('optometrista.consulta.show-consulta')
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
@endsection
@push('after-scripts')
    <script src="{{asset('assets/js/pages/tables/editable-table.js')}}"></script>
    <script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
    <script src="{{asset('assets/plugins/editable-table/mindmup-editabletable.js')}}"></script>
    <script src="{{asset('assets/js/js_propios/js_optometrista/js_consulta/script.js')}}"></script>
@endpush
