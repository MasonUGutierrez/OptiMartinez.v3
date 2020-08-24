@extends('layout.master')
@section('parentPageTitle', 'Historia Clinica')
@section('title', 'Nueva Consulta')

@section('page-style')
    {{-- Estilos para el sweetalert --}}
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}">
    {{-- Estilos para la jQuery DataTable --}}
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
@endsection

@section('content')
    <input type="hidden" id="ids" value="{{$hclinica->id_historia_clinica}}">
    <input type="hidden" id="hack" value="2">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header mb-2"><h2><strong>Nueva</strong> Consulta</h2></div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label>Nombre del Cliente</label>
                                <input type="text" readonly id="nombreCliente" class="form-control"
                                       placeholder="Nombre...">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Fecha</label>
                                <input type="date" id="FechaNewConsulta" readonly class="form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nombre de Jornada</label>
                                <select id="jornadaNombres" class="form-control show-tick ms select2"
                                        data-placeholder="Seleccione Jornada...">
                                    <option ></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header mb-2 ml-3"><h2><strong>Examen</strong> Visual</h2></div>
                <div class="body">
                    <div class="row clearfix">
                        <div class=" col-lg-8 col-md-12">
                            <table id="mainTable" style="text-align: center"
                                   class="table table-striped table-bordered c_table">
                                <thead>
                                <tr>
                                    <th>Ojo</th>
                                    <th>Esfera</th>
                                    <th>Cilindro</th>
                                    <th>Eje</th>
                                    <th>Adición</th>
                                    <th>Agudeza Visual</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>O.D</th>
                                    <td id="esd">0.0</td>
                                    <td id="cd">0.0</td>
                                    <td id="ejd">0.0</td>
                                    <td id="ad">0.0</td>
                                    <td id="avd">0.0</td>
                                </tr>
                                <tr>
                                    <th>O.I</th>
                                    <td id="esi">0.0</td>
                                    <td id="ci">0.0</td>
                                    <td id="eji">0.0</td>
                                    <td id="ai">0.0</td>
                                    <td id="avi">0.0</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class=" col-lg-4 col-md-12">
                            <table id="mainTable2" style="text-align: center"
                                   class="table table-bordered table-striped c_table">
                                <thead>
                                <tr>
                                    <th>D.P.</th>
                                    <th>Alt.</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td id="dp">0.0</td>
                                    <td id="alt">0.0</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header mb-2 ml-3 col-sm-12"><h2><strong>Observaciones</strong></h2></div>
                <div class="body">
                    <div class="form-group">

                        <div class="form-line">
                                    <textarea id="observ" rows="4" class="form-control no-resize"
                                              placeholder="Observaciones..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header mb-2 ml-1 col-sm-12"><h2><strong>Retinoscopia</strong></h2></div>
                <div class="checkbox">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input id="checkbox12" type="checkbox">
                            <label for="checkbox12">Seleccione para mostrar campo.</label>
                        </div>
                    </div>
                </div>
                <div class="body" id="desaparecer">
                    <div class="form-group">
                        <div class="form-line">
                                    <textarea id="hallazgo" rows="4" class="form-control no-resize"
                                              placeholder="Hallazgos de Retinoscopia..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-sm-4 offset-sm-4">
            <button class="btn btn-primary" type="submit" id="guardar"
                    onclick="newConsulta()">Guardar
            </button>
            <button class="btn btn-danger"  type="reset">Cancelar
            </button>
        </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
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

    <script src="{{asset('assets/js/pages/tables/editable-table.js')}}"></script>
    <script src="{{asset('assets/plugins/editable-table/mindmup-editabletable.js')}}"></script>
    {{-- Script para inicializar el sweetalert --}}
    <script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>
    {{-- Script para inicializar el jQuery DataTable --}}
    <script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
    {{--<script async="async">
        var obj_hclinica = @json($hclinica);
        // var hclinica = {{json_encode($hclinica)}};
        console.log(obj_hclinica);
    </script>--}}
    <script src="{{asset('assets/js/js_propios/js_optometrista/js_consulta/script2.js')}}"></script>
@endpush
