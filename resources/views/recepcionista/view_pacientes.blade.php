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
                        <table class="table table-hover table-bordered theme-color dataTable-hc" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Paciente</th>
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
    {{-- <script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script> --}}

    {{-- Script para inicializar SweetAlert --}}
    <script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>

    <script type="text/javascript" async="async">
        $(function(){
            data();
        });
        // Solucion de problema con tooltip en los botones que se crean por la peticion ajax
        $(document).ajaxComplete(function(){
            // $('[data-toggle="tooltip"]').tooltip();

            $('.darBaja').on('click', function(event){
                event.preventDefault();
                console.log('Probando Swal');
                swal({
                    title:'¿Estás seguro?',
                    text:$(this).data('text'),
                    icon:'warning',
                    buttons:{
                        cancel:'Cancelar',
                        confirm:{
                            text:'Aceptar',
                            className:'btn-warning'
                        }
                    },
                    dangerMode:true
                }).then((willDelete)=>{
                    if(willDelete){
                        swal($(this).data('obj') + " dada de baja",{
                            icon:"success",
                            button:"Aceptar"
                        }).then(()=>{
                            fnDelete($(this));
                        });
                    }
                    else{
                        cancelSwal();
                    }
                });
            });
        });
        $('#Guardar').on('click', function(event){
            event.preventDefault();
            fnStore();
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function cancelSwal(){
            swal({
                text:'¡Acción Cancelada!',
                icon: 'error',
                button: 'Aceptar'
            });
        }
        function fnDelete(element){
            $.ajax(element.attr('href'),{
                type:'DELETE',
                success:function(datas, status, jqXhr){
                    console.log('Message: ' + datas);
                    data();
                },
                error:function(jqXhr, textStatus, errorThrown){
                    console.log('status: ' + textStatus);
                    console.log('error: ' + errorThrown);
                    console.log('jQuery XMLHTTPRequest object: \n');
                    console.log(jqXhr);
                }
            });
        }
        function data(){
            // let data_tr = "";
            // Agregando directamente el responseJSON devuelto del controlador al DataTable
            $('.dataTable-hc').DataTable({
                destroy:true,
                // processing:true,
                serverSide:true,
                ajax: {
                    url:'historias-clinicas/all',
                    type:'GET'
                    // dataSrc: ''
                },
                columns:[
                    {data:'id_historia_clinica',width: "10%"},
                    {data:'paciente'},
                    {data:'fecha_registro',width:"20%"},
                    {data:'opciones', name:"opciones", orderable:false, searchable: false, width:"20%"}
                ],
                lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "Todo"]],
                language:{
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                }
            });
        }
        function fnStore(){
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
                data: sendData,
                url: `{{action('OpticaControllers\HClinicaController@store')}}`,
                success: function(datas){
                    console.log(datas.nombre + 'Registrado!!');
                    fnClearFields();

                    // $('.dataTable-hc').fnDestroy();
                    data();
                },
                error: function(jqXHR, statusText, errorThrown){
                    console.log('Error::'+errorThrown);
                    console.log('Error::'+statusText);

                    console.log(jqXHR);

                }
            });
            function fnClearFields()
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
