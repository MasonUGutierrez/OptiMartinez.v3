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
                <input type="hidden" id="historiasid" value="{{$hclinica->id_historia_clinica}}">
                <div class="body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{$hclinica->paciente->nombres}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="{{$hclinica->paciente->apellidos}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="cedula">Identificación: </label>
                            <input type="text" class="form-control" id="cedula" name="cedula" value="{{$hclinica->paciente->cedula}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <strong>Últimas</strong> medidas
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Imprimir">
                        <a href="#" class="btn btn-sm btn-raised btn-danger waves-effect waves-light">
                            <i class="zmdi zmdi-print"></i>
                        </a>
                    </span>
                    </h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-9">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover c_table theme-color" id="medidasOjos">
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
                                @if(Session::has('error_message'))
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-center">
                                                {{Session::get('error_message')}}
                                            </p>
                                        </td>
                                    </tr>
                                @else
                                    @foreach($uConsultaServicios[0]->examenVisual->medidasOjos as $medidaOjo)
                                        <tr>
                                            @if($medidaOjo->ojo == '0')
                                                <td>O.D</td>
                                            @else
                                                <td>O.I</td>
                                            @endif
                                            <td>{{$medidaOjo->cilindro}}</td>
                                            <td>{{$medidaOjo->adicion}}</td>
                                            <td>{{$medidaOjo->agudeza_visual}}</td>
                                            <td>{{$medidaOjo->esfera}}</td>
                                            <td>{{$medidaOjo->eje}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                {{-- @if($uConsultaServicios == null)
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-center">
                                                No existen registros de medidas <br>  para esta Historia Clinica
                                            </p>
                                        </td>
                                    </tr>
                                @endif   --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered theme-color c_table">
                                <thead>
                                <tr>
                                    <td>D.P</td>
                                    <td>Alt</td>
                                </tr>
                                </thead>
                                <tbody>
                                @if(Session::has('error_message'))
                                    <tr>
                                        <td colspan="2">
                                            <p class="text-center">
                                                {{Session::get('error_message')}}
                                            </p>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$uConsultaServicios[0]->examenVisual->distancia_pupilar}}</td>
                                        <td>{{$uConsultaServicios[0]->examenVisual->alt}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if(!session('error_message'))
                        <div class="col-lg-12">
                            <small class="text-muted">
                                <div class="form-group row mb-0">
                                    <label for="" class="col-sm-auto col-form-label">Consulta realizada: </label>
                                    <div class="col">
                                        <input type="date" class="form-control-plaintext" readonly value="{{$uConsultaServicios[0]->consulta->fecha}}">
                                    </div>
                                </div>
                            </small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('optometrista.consulta.show-consulta')
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

    <script >
        $(function(){
            {{--console.log(@json($uConsultaServicios));
            var tr = "";
            if(@json($uConsultaServicios))
            {
                console.log("Entre por que no es null");
                @if($uConsultaServicios)
                var medidasOjos = @json($uConsultaServicios[0]->examenVisual->medidasOjos),
                    examenVisual = @json($uConsultaServicios[0]->examenVisual);
                @endif
                medidasOjos.forEach(element => {
                    tr += `<tr>`;
                    if(element.ojo == '0')
                    {
                        tr += `<td>O.D</td>`;
                    }
                    else
                    {
                        tr += `<td>O.I</td>`;
                    }
                    tr += `<td>${element.cilindro}</td>
                        <td>${element.adicion}</td>
                        <td>${element.agudeza_visual}</td>
                        <td>${element.esfera}</td>
                        <td>${element.eje}</td>
                        </tr>`;
                });
                $("#medidasOjos > tbody").append(tr);
            }--}}
        });
        // var hclinica = {{json_encode($hclinica)}};

        // console.log(medidasOjos.length);
        // console.log(medidasOjos, examenVisual);
    </script>
    <script src="{{asset('assets/js/pages/tables/editable-table.js')}}"></script>
    <script src="{{asset('assets/plugins/editable-table/mindmup-editabletable.js')}}"></script>
    <script src="{{asset('assets/js/js_propios/js_optometrista/js_consulta/script.js')}}"></script>
@endpush
