@extends('layout.master')
{{--@section('parentPageTitle', 'Pages')--}}
@section('title', 'Servicios')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/morrisjs/morris.css')}}"/>
    {{-- Estilos para Datatable --}}
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Listado </strong>de Servicios
                            <span class="btn btn-sm btn-success">
                                <a  data-toggle="modal" data-target=".servicioadd"><i class="zmdi zmdi-account-add"></i></a>
                            </span>

                        </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dataTable-servicio theme-color mb-0" width="100%">
                            <thead>
                            <tr style="text-align: center">
                                <th>Servicio</th>
                                <th>Precio</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody id="tablas" style="text-align: center">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('servicios.modal-edit')
    @include('servicios.modal-new')
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
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script src="{{asset('assets/js/js_propios/js_servicios/script.js')}}"></script>
@endpush
