@extends('layout.master')
@section('parentPageTitle', '')
@section('title', 'Historias Clinicas')

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
                    <table class="table table-hover table-bordered theme-color dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Paciente</th>
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
@endsection

@push('after-scripts')
    {{-- Scripts para inicializar DataTable --}}
    <script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>

    {{-- Script para inicializar SweetAlert --}}
    <script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>

    <script type="text/javascript" async="async">
        $(function(){
            data();
        });

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function data()
        {
            let data_tr = "";
            // $('.dataTable-hc').DataTable({
            //     ajax: {
            //         url:'historias-clinicas/all',
            //         dataSrc: ''
            //     },
            //     columns:[
            //         {data:'id_historia_clinica'},
            //         {data:'id_paciente'},
            //         {data:'fecha_registro'},
            //     ]
            // });
            $.ajax({
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
                            url:`{{url('historias-clinicas/getpaciente/${hclinica.id_historia_clinica}')}}`,
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
        }
        $('#Guardar').on('click', function(event){
            event.preventDefault();
            store();
        })

        function store()
        {
            var sendData = {
                nombre:$('#nombre').val(),
                apellido:$('#apellido').val(),
                edad:parseInt($('#edad').val()),
                cedula:$('#cedula').val(),
                telefono:$('#telefono').val(),
                direccion:$('#direccion').val(),
                antecedentes:$('#antecedentes').val()
            };
            console.log(typeof sendData.edad);
            console.log(`{{action('OpticaControllers\HClinicaController@store')}}`);

            $.ajax({
                type: 'POST',
                dataType: 'json',
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                data: sendData,
                url: `{{action('OpticaControllers\HClinicaController@store')}}`,
                success: function(datas){
                    console.log(datas.nombre + 'Registrado!!');
                    clearData();                
                    data();
                },
                error: function(jqXHR, statusText, errorThrown){
                    console.log('Error::'+errorThrown);
                    console.log('Error::'+statusText);

                    // var errorLaravel = JSON.stringify(jqXHR);
                    console.log(jqXHR);

                    // var convertResponseText = JSON.parse(jqXHR.responseText);

                    // console.log(convertResponseText);

                }
                // error:function(result){
                //     if(result.responseJSON.errors){
                //         console.log('Hay errores en los campos');
                //     }
                //     console.log(result.responseJSON.errors);
                // }
            });   
            function clearData()
            {
                $('#nombre').val("");
                $('#apellido').val("");
                $('#edad').val("");
                $('#cedula').val("");
                $('#telefono').val("");
                $('#direccion').val("");
                $('#antecedentes').val("");
            } 
        }
    </script>
@endpush