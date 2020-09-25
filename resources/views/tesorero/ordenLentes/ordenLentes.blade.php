@extends('layout.master')
@section('title', 'Orden Lentes')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/multi-select/css/multi-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-spinner/css/bootstrap-spinner.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>

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
                    <div class="col-4">
                        <div class="form-group pl-4">
                            <label for=""><strong>Seleccione el Tipo de Lente</strong></label>
                            <div class="custom-control custom-checkbox checkbox-inline">
                                <input type="checkbox"  class="custom-control-input " id="monofocal">
                                <label class="custom-control-label checkbox-inline" for="monofocal">Monofocal</label>
                            </div>
                            <div class="custom-control custom-checkbox checkbox-inline">
                                <input type="checkbox"  class="custom-control-input " id="bifocal">
                                <label class="custom-control-label checkbox-inline" for="bifocal">Bifocal</label>
                            </div>
                            <div class="custom-control custom-checkbox checkbox-inline">
                                <input type="checkbox" class="custom-control-input " id="invisible">
                                <label class="custom-control-label checkbox-inline" for="invisible">Invisible</label>
                            </div>
                            <div class="custom-control custom-checkbox checkbox-inline">
                                <input type="checkbox" class="custom-control-input " id="progresivo">
                                <label class="custom-control-label checkbox-inline" for="progresivo">Progresivo</label>
                            </div>

                            {{--<select class=" show-tick ms form-control select2 center-block border rounded"  id="tipoLente" multiple required data-placeholder="Seleccione el Tipo de Lente">
                                <option></option>
                            </select>--}}
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group pl-4">
                            <label for=""><strong>Seleccione el Tipo de Material</strong></label>
                            <div class="custom-control custom-checkbox checkbox-inline">
                                <input type="checkbox"  class="custom-control-input " id="plastico">
                                <label class="custom-control-label checkbox-inline" for="plastico">Plastico</label>
                            </div>
                            <div class="custom-control custom-checkbox checkbox-inline">
                                <input type="checkbox"  class="custom-control-input " id="policarbonato">
                                <label class="custom-control-label checkbox-inline" for="policarbonato">Policarbonato</label>
                            </div>
                            <div class="custom-control custom-checkbox checkbox-inline">
                                <input type="checkbox" class="custom-control-input " id="vidrio">
                                <label class="custom-control-label checkbox-inline" for="vidrio">Vidrio</label>
                            </div>
                            <div class="custom-control custom-checkbox checkbox-inline">
                                <input type="checkbox" class="custom-control-input " id="antirreflejo">
                                <label class="custom-control-label checkbox-inline" for="antirreflejo">Antirreflejo</label>
                            </div>
                            <div class="custom-control custom-checkbox checkbox-inline">
                                <input type="checkbox" class="custom-control-input " id="transition">
                                <label class="custom-control-label checkbox-inline" for="transition">Transition</label>
                            </div>
                            {{--<select class=" show-tick ms form-control select2 center-block border rounded" id="tipoMaterial" multiple required data-placeholder="Seleccione el Tipo de Material">
                                <option></option>
                            </select>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
