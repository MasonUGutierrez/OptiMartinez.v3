@extends('layout.master')
@section('title', 'Orden Lentes')
@section('parentPageTitle', 'Orden Lentes')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
    {{-- Estilos para Datatable --}}
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
    <style>

    </style>
@stop
@section('content')
<div class="row clearfix">
    <div class="col-lg-10">
        <div class="card">
            <div class="header">
                <h2><strong>Lista</strong> de Clientes en Espera</h2>
                    <span  class="btn btn-success align-right"><a
                        href="/ordendeLente" style="color: white">Orden de Lente</a>
                    </span>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover theme-color mb-0 dataTable" id="datatable">
                        <thead>
                        <tr style="text-align: center" >
                            {{--<th>ID</th>--}}
                            <th>Paciente Id.</th>
                            <th >Nombre</th>
                            <th>Apellido</th>
                            <th>Opciones</th>

                        </tr>
                        </thead>

                        <tbody>
                        @foreach($paciente as $cat)
                            <tr style="text-align: center">
                                <td>{{$cat->id_paciente}}</td>
                                <td>{{$cat->nombres}} </td>
                                <td>{{$cat->apellidos}}</td>
                                <td><span class="btn btn-primary">Nueva Orden</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Ultimas </strong>Ordenes de Lentes</h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover theme-color mb-0 dataTable" id="datatables">
                        <thead>
                        <tr style="text-align: center" >
                            {{--<th>ID</th>--}}
                            <th>Paciente Id.</th>
                            <th >Nombre y Apellido</th>
                            <th>Fecha</th>
                            <th>Cuenta</th>
                            <th>Concepto</th>
                            <th>Opciones</th>

                        </tr>
                        </thead>

                        <tbody>
                        @foreach($tablaConcepto as $cat)
                            <tr style="text-align: center">
                                <td>{{$cat->id_paciente}}</td>
                                <td>{{$cat->nombres}} {{$cat->apellidos}}</td>
                                <td>{{$cat->fecha}}</td>
                                <td>{{$cat->estado_cuenta_cobrar}}</td>
                                <td style="text-align: left">
                                    <small>Marco:{{$cat->cod_marco}}</small><br>
                                    <small>Lente:{{$cat->tipo_lente}}</small><br>
                                    <small>Material:{{$cat->material_mica}}-{{$cat->marca_material}}</small>
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('page-script')
    {{-- Scripts para DataTable --}}
    <script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
    {{-- Scripts para los botones de jqueryDataTable --}}
    <script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
@stop
@push('after-scripts')
    <script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
@endPush
