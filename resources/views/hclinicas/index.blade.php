@extends('layout.master')
@section('parentPageTitle', '')
@section('title', 'Historias Clinicas')

@section('page-style')
{{-- Estilos para Datatable --}}
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
{{-- Estilos para SweetAlert --}}
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}">

<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>

{{-- Estilos para el Jquery-steps --}}
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-steps/jquery.steps.css')}}">

<style>
    .format-textarea{
        width:100%;
        height: 100px;
        min-height: 100px;
        max-height: 100px;
    }
</style>
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Listado</strong> de Historias Clinicas
                    <span class="d-inline-block" data-toggle="tooltip" tabindex="0" title="Nueva Historia Clinica">
                        <a href="{{--action('OpticaControllers\HClinicaController@index')--}}"
                            class="btn btn-raised btn-sm btn-success waves-effect waves-light "
                            data-toggle="modal"
                            data-target="#AddPaciente">
                            <i class="zmdi zmdi-plus"></i>
                        </a>
                    </span>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <!--agregando propiedad width="100%" para que el contenido se desplace-->
                    <table class="table table-hover table-bordered theme-color dataTable-hc text-center" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Paciente</th>
                                <th>Edad</th>
                                <th>Telefono</th>
                                <th>Registro</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($hclinicas as $hclinica)
                                <tr>
                                    <td>{{$hclinica->id_historia_clinica}}</td>
                                    <td>{{$hclinica->paciente->nombre . " " . $hclinica->paciente->apellido}}</td>
                                    <td>{{$hclinica->fecha_registro}}</td>
                                    <td></td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="method" value="POST" name="_method">
@include('hclinicas.modal-addpaciente')
@endsection

@section('page-script')
{{-- Scripts para DataTable --}}
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
{{-- Scripts para los botones de jqueryDataTable --}}
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>

{{-- Script para SweetAlert --}}
<script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>

<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

{{-- Script para el Jquery-validate plugin --}}
<script src="{{asset('assets/plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-validation/localization/messages_es.js')}}"></script>
{{-- Script para el Jquery-steps --}}
<script src="{{asset('assets/plugins/jquery-steps/jquery.steps.js')}}"></script>
@endsection

@push('after-scripts')
    {{-- Scripts para inicializar DataTable --}}
    {{-- <script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script> --}}

    {{-- Script para inicializar SweetAlert --}}
    <script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>

    <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
    <script src="{{asset('assets/js/js_propios/js_hclinica/script.js')}}" defer></script>
    
    <script type="text/javascript">
        $(function(){
            // data(); 

            // console.log(initValidateStep);
            initValidateStep('POST');

          
            
            /* $('#AddPaciente').on('shown.bs.modal', function(){
                var initial = $('#checkCedula').is(':checked');

                if (initial){
                    $('#cedula').prop('disabled', false);
                    $('#cedObl').show();
                    $('#checkCedula').prop('checked', false);                 
                } 
            }); */
            // Trabajando evento click en el boton cancelar del modal
            /* $('#btnCancel').on('click', function(event){
                // Previniendo que se cierre el modal
                event.preventDefault();

                // Limpiando campos
                fnClearFields();
                // Cambiando el toggle del modal
                $('#AddPaciente').modal('toggle');
            }); */           
        });
        
        // Metodo para determinar si es año bisiesto
        /* function isLeapYear(year){
            /* Para determinar si un año es bisiesto, siga estos pasos:

                Si el año es uniformemente divisible por 4, vaya al paso 2. De lo contrario, vaya al paso 5.
                Si el año es uniformemente divisible por 100, vaya al paso 3. De lo contrario, vaya al paso 4.
                Si el año es uniformemente divisible por 400, vaya al paso 4. De lo contrario, vaya al paso 5.
                El año es un año bisiesto (tiene 366 días).
                El año no es un año bisiesto (tiene 365 días). 
            */
            /*return ((year % 4 == 0 && year % 100 != 0) || year % 400 == 0) ? true : false;
        } */

        // Metodo para obtener un numero aleatorio en una cantidad determinada de numeros
        /* function getRandomInt(max){
            return Math.floor(Math.random() * Math.floor(max));
        } */


        /* $('#Guardar').on('click', function(event){
            event.preventDefault();
            fnStore();
        }); */

        /* function data(){
            // let data_tr = "";
            /* $.ajax({
                type: 'GET',
                dataType: 'json',
                url: 'historias-clinicas/all',
                // Obteniendo todas las historias clinicas
                success: function(data){
                    console.log(data);
                    // Recorriendo cada historia clinica para determinar el paciente
                    $.each(data, function(key, hclinica){
                        // console.log(hclinica.id_paciente);
                        // Peticion AJAX para obtener el paciente de determinada historia clinica
                        $.ajax({
                            type:'GET',
                            dataType: 'json',
                            url:`{{url('historias-clinicas/gethistoria/${hclinica.id_historia_clinica}')}}`,
                            success: function(response1){
                                // console.log(response1.nombre);
                                data_tr += `
                                <tr>
                                    <td>${hclinica.id_historia_clinica}</td>
                                    <td>${response1.nombre} ${response1.apellido}</td>
                                    <td>${hclinica.fecha_registro}</td>
                                    <td></td>
                                </tr>`;
                                $('.dataTable > tbody').html(data_tr);
                            }
                        });
                    })
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('Error: ' + jsXHR + '\n Error string: ' + textStatus + '\n Error Throwed: ' + errorThrown);
                    // console.log(response);
                }
            });
        }  */ 
    </script>
@endpush
