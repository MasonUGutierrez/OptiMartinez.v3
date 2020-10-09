@extends('layout.master')
@section('parentPageTitle', '')
@section('title', 'Pacientes')

@section('page-style')
    {{-- Estilos para Datatable --}}
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
    {{-- Estilos para SweetAlert --}}
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}">

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
                    <h2><strong>Listado</strong> de Pacientes
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
                        <table class="table table-hover table-bordered theme-color dataTable-hc" width="100%" style="text-align: center">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('recepcionista.modal-addpaciente')
    <input type="hidden" value="POST" name="_method" id="method">
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

    {{-- Script para el Jquery-validate plugin --}}
    <script src="{{asset('assets/plugins/jquery-validation/jquery.validate.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-validation/localization/messages_es.js')}}"></script>
@endsection

@push('after-scripts')
    {{-- Scripts para inicializar DataTable --}}
    {{-- <script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script> --}}

    {{-- Script para inicializar SweetAlert --}}
    <script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>

    <script src="{{asset('assets/js/js_propios/js_hclinica/script.js')}}" defer></script>

    <script type="text/javascript" async="async">
        $(function(){
            var form = $('#hclinica_form').show();
            validateRules(form);
        });
        $('#Guardar').on('click', function(event){
            event.preventDefault();
            var form = $('#hclinica_form').show();

            // validateRules(form);

            form.validate();

            if(form.valid()){
                fnStore("POST");

                swal({
                    title:"Bien Hecho",
                    text:"Paciente "+$('#nombres').val() + " " + $('#apellidos').val()+" Registrado",
                    icon: "success"
                }).then(()=>{
                    $("#AddPaciente").modal('toggle');
                });
            }
        });
    </script>
@endpush
