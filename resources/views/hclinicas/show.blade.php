@extends('layout.master')
@section('parentPageTitle', 'Historia Clinica')
@section('title', 'Detalles')

@section('page-style')
{{-- Estilos para el sweetalert --}}
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}">
{{-- Estilos para la jQuery DataTable --}}
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">

{{-- Estilos para el Jquery-steps --}}
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-steps/jquery.steps.css')}}">
@endsection
@section('addButton')
    <span class="d-inline-block float-right" tabindex="0" data-toggle="tooltip" data-placement="left" title="Regresar">
    <button class="btn btn-primary btn-round btn-icon waves-effect waves-light" onclick="history.back()"><i class="zmdi zmdi-arrow-left"></i></button>
</span>
@endsection

@section('content')
{{-- Row para los datos generales --}}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card" id="stepsCard">
            {{-- header del card de historia, contiene el boton de editar --}}
            <div class="header">
                <h2>
                    <strong>Detalles</strong> Historia Clinica
                    <span id="containerBtnEditar">
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Editar">
                            <a href="" class="btn btn-raised btn-sm btn-primary waves-effect waves-light" id="btnEditar">
                                <i class="zmdi zmdi-edit"></i>
                            </a>
                        </span>
                    </span>
                    <span id="containerBtnCancelar">
                        <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Cancelar">
                            <a href="" class="btn btn-sm btn-raised btn-danger waves-effect waves-light" id="btnCancelar">
                                <i class="zmdi zmdi-block-alt"></i>
                            </a>
                        </span>
                    </span>
                </h2>
            </div>
            <input type="hidden" id="historiasid" value="{{$hclinica->id_historia_clinica}}">
            <div class="body">
                <form id="editHClinica" method="POST">
                    <input type="hidden" id="method" name="_method" value="PUT">
                    <h3>Datos Personales</h3>
                    <fieldset>
                        {{-- Row para inputs nombres y apellidos --}}
                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nombres">Nombres </label>
                                    <input type="text" disabled id="nombres" name="nombres" class="form-control" placeholder value="{{$hclinica->paciente->nombres}}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="apellidos"> Apellidos</label>
                                    <input type="text" disabled id="apellidos" name="apellidos" class="form-control" placeholder value={{$hclinica->paciente->apellidos}}>
                                </div>
                            </div>
                        </div>
                        {{-- Row para inputs fecha, edad y sexo --}}
                        <div class="row clearfix">
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="date" disabled class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="" value="{{$hclinica->paciente->fecha_nacimiento}}">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="edad">Edad</label>
                                    <input type="number" disabled class="form-control" name="edad" id="edad" disabled placeholder="" value="{{$hclinica->paciente->edad}}">
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <div>
                                        <label for="sexo">Sexo</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" disabled class="custom-control-input" name="sexo" id="maleRadio" {{($hclinica->paciente->sexo == 'masculino')?'checked':''}} value="masculino">
                                            <label class="custom-control-label" for="maleRadio">Masculino</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" disabled class="custom-control-input" name="sexo" id="femaleRadio" {{($hclinica->paciente->sexo == 'femenino')?'checked':''}} value="femenino">
                                            <label class="custom-control-label" for="femaleRadio">Femenino</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Row para inputs cedula y telefono --}}
                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <label for="cedula">Cedula</label>
                                        </div>
                                        {{-- Checkbox para confirmar si tiene cedula --}}
                                        <div class="col-md-6" id="checkContainer">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" id="checkCedula" class="custom-control-input" disabled>
                                                <label class="custom-control-label" for="checkCedula">
                                                    <small>No tiene cedula</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" disabled class="form-control" name="cedula" id="cedula" value="{{$hclinica->paciente->cedula}}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="telefono">Telefono</label>
                                    <input type="text" disabled class="form-control" name="telefono" id="telefono" value="{{$hclinica->paciente->telefono}}">
                                </div>
                            </div>
                        </div>
                        {{-- Row para textarea direccion --}}
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <textarea class="form-control no-resize" disabled rows="4" name="direccion" id="direccion">{{$hclinica->paciente->direccion}}</textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <h3>Datos Ananmesis</h3>
                    <fieldset>
                        {{-- Row para los textareas historias ocular e historia medica --}}
                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-12">
                                <label for="h_ocular">Historia Ocular</label>
                                <textarea class="form-control no-resize" disabled rows="4" name="h_ocular" id="h_ocular">{{$hclinica->h_ocular}}</textarea>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="h_medica">Historia Medica</label>
                                <textarea class="form-control no-resize" disabled rows="4" name="h_medica" id="h_medica" placeholder="Hola soy un placeholder">{{$hclinica->h_medica}}</textarea>
                            </div>
                        </div>
                        {{-- Row para el textarea medicaciones --}}
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <label for="medicaciones">Medicaciones</label>
                                <textarea class="form-control no-resize" disabled rows="4" name="medicaciones" id="medicaciones">{{$hclinica->medicaciones}}</textarea>
                            </div>
                        </div>
                        {{-- Row para el textarea alergias --}}
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <label for="alergias">Alergias</label>
                                <textarea class="form-control no-resize" disabled rows="4" name="alergias" id="alergias">{{$hclinica->alergias}}</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <h3 data-id="medidasTitle">Ultimas Medidas</h3>
                    <fieldset data-id="medidasContainer">
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
                    </fieldset>
                </form>
                <div id="containerHidden" style="display:none;"></div>
                {{-- <div class="row">
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
                </div> --}}
            </div>
        </div>
    </div>
</div>
{{-- Row para las ultimas medidas --}}
{{-- <div class="row clearfix">
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
            <div class="body">
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
                                    @endif
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
</div> --}}
{{-- Row para el listado de consultas --}}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>
                    <strong>Listado</strong> Consultas
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Registrar Consulta">
                        <a href="{{action('OpticaControllers\ConsultaController@create',$hclinica->id_historia_clinica)}}" class="btn btn-raised btn-sm btn-success waves-effect waves-light">
                            <i class="zmdi zmdi-plus"></i>
                        </a>
                    </span>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive-md">
                    <table class="table table-hover dataTable-consulta table-bordered theme-color dataTable" width="100%">
                        <caption>Lista de consultas</caption>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre de la Jornada</th>
                                <th>Fecha</th>
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

{{-- Script para el Jquery-validate plugin --}}
<script src="{{asset('assets/plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-validation/localization/messages_es.js')}}"></script>
{{-- Script para el Jquery-steps --}}
<script src="{{asset('assets/plugins/jquery-steps/jquery.steps.js')}}"></script>

@endsection
@push('after-scripts')
{{-- Script para inicializar el sweetalert --}}
<script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>
{{-- Script para inicializar el jQuery DataTable --}}
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>

<script src="{{asset('assets/js/js_propios/js_hclinica/script.js')}}" defer></script>

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

        initStepTab();

        $('#containerBtnCancelar').hide();

        // Evento clic del btnEditar para cambiar el steps a modo editable
        $('#btnEditar').on('click',function(event){
            event.preventDefault();

            var form = $('#editHClinica');

            form.removeClass('tabcontrol');
            form.steps('destroy');


            $('[data-id=medidasTitle]').appendTo('#containerHidden');
            $('[data-id=medidasContainer]').appendTo('#containerHidden');
            $('#containerBtnEditar').hide();
            $('#containerBtnCancelar').show();

            enableFields(true);
            initValidateStep('PUT');
            // funcion para establecer los eventos en los inputs despues del steps.destroy
            setEvents();

        });
        // Evento clic del btnCancelar para cambiar el steps a modo no editable
        $('#btnCancelar').on('click',function(event){
            event.preventDefault();

            var form = $('#editHClinica');

            form.removeClass('wizard');
            form.steps('destroy');

            $('[data-id=medidasTitle]').appendTo('#editHClinica');
            $('[data-id=medidasContainer]').appendTo('#editHClinica');
            $('#containerBtnCancelar').hide();
            $('#containerBtnEditar').show();

            enableFields(false);
            initStepTab();

        });

        /*Pruebas para ocultar el ultimo steps de las medidas para cuando vaya a edtar*/
        // $('[data-id=medidasTitle]').remove();
        // $('[data-id=medidasContainer]').remove();
    });
    // var hclinica = {{json_encode($hclinica)}};

    // console.log(medidasOjos.length);
    // console.log(medidasOjos, examenVisual);
</script>
<script src="{{asset('assets/js/pages/tables/editable-table.js')}}"></script>
<script src="{{asset('assets/plugins/editable-table/mindmup-editabletable.js')}}"></script>
<script src="{{asset('assets/js/js_propios/js_optometrista/js_consulta/script.js')}}"></script>
@endpush
