@extends('layout.master')
@section('title', 'Orden Lentes')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/multi-select/css/multi-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-spinner/css/bootstrap-spinner.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
        }
    </style>

@stop
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Nueva</strong> Orden de Lentes</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-md-6 offset-md-3">
                        <div class="form-group text-center">
                            <label ><strong>Seleccione un Paciente</strong></label>
                            <select  class=" form-control show-tick ms select2 center-block border rounded" id="nombrePacientes" required data-placeholder="-- Seleccione un Paciente --">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="idHistoriaCuenta">
            <input type="hidden" id="fecha">
            <input type="hidden" id="historiaClinica">
            <div class="header">
                <h2><strong>Datos</strong> Generales</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nombre"><strong>Nombres</strong></label>
                            <input id="nombre" class="form-control" name="nombre" type="text" disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="apellidos"><strong>Apellidos</strong></label>
                            <input id="apellidoPaciente" class="form-control" name="apellidos" type="text" disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="identificacion"><strong>Identificación</strong></label>
                            <input id="identificacion" class="form-control" name="identificacion" type="text" disabled>
                        </div>
                    </div>
                   <div class="col-6">
                       <div class="form-group">
                           <label for="edad"><strong>Edad</strong></label>
                           <input id="edadPaciente" class="form-control" name="edad" type="text" disabled>
                       </div>
                   </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-9">
                        <div class="table-responsive">
                            <table class="table text-center table-bordered table-hover c_table theme-color" id="medidasOjos">
                                <thead>
                                <tr>
                                    <td>Ojo</td>
                                    <td>Cil.</td>
                                    <td>Ad.</td>
                                    <td>A.V</td>
                                    <td>Esf</td>
                                    <td>Eje</td>
                                </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                                <td>O.D</td>
                                                <td>O.I</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="table-responsive">
                            <table class="table text-center table-hover table-bordered theme-color c_table">
                                <thead>
                                <tr>
                                    <td>D.P</td>
                                    <td>Alt</td>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                        <div class="col-lg-12">
                            <small class="text-muted">
                                <div class="form-group row mb-0">
                                    <label for="" class="col-sm-auto col-form-label">Consulta realizada: </label>
                                    <div class="col">
                                        <input type="date" class="form-control-plaintext" readonly value="">
                                    </div>
                                </div>
                            </small>
                        </div>
                </div>
            </div>
            <div class="header">
                <h2><strong>Detalles</strong> del Marco</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""><strong>Seleccione una Marca</strong></label>
                            <select class=" show-tick ms select2 form-control center-block border rounded" id="marca" required data-placeholder="Seleccione una Marca">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""><strong>Seleccione un Marco</strong></label>
                            <select class=" show-tick ms form-control select2 center-block border rounded" id="marco" required data-placeholder="Seleccione un Marco">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row clearfix">
                            <div class="col-md-4 offset-md-4">
                                <div class="form-group">
                                    <label for="fotoMarco"><strong>Foto del Marco</strong></label>
                                    <div class="form-group">
                                        <img id="fotoMarco" width="150" class="rounded img-raised" alt="No cuenta con una foto el Marco">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="header">
                <h2><strong>Tipo</strong> de Lente y Material</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group ">
                            <div class="text-center">
                                <label class="pr-5"><strong>Seleccione el Tipo de Lente</strong></label>
                            </div>

                            <select class=" show-tick ms form-control select2 center-block border rounded"  id="tipoLente"  required data-placeholder="Seleccione el Tipo">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group ">
                            <div class="text-center">
                                <label class="pr-5"><strong>Seleccione el Material de la Mica</strong></label>
                            </div>

                            <select class=" show-tick ms form-control select2 center-block border rounded" id="tipoMaterial"  required data-placeholder="Seleccione el Tipo">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group ">
                            <div class="text-center">
                                <label class="pr-5"><strong>Seleccione el Filtro del Lente</strong></label>
                            </div>
                            <select class=" show-tick ms form-control select2 center-block border rounded" id="filtro" multiple required data-placeholder="Seleccione un Filtro">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <span class="btn btn-primary " data-toggle="modal" onclick="fecha()" data-target="#largeModal"> Aceptar

            </span>
        </div>
    </div>
</div>
@include('tesorero.ordenLentes.modal_ordenLente')
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
@stop
@push('after-scripts')
    <script src="{{asset('assets/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-spinner/js/jquery.spinner.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
    <script src="{{asset('assets/js/js_propios/tesorero/script.js')}}"></script>
@endpush
