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
                    <table class="table table-hover table-bordered theme-color dataTable-hc">
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
    
    <script type="text/javascript" async="async">
        $(function(){
            data(); 
            /* // Implementando datepicker - da error en los estilos o en los datos que envian
            var datepicker = $('#fecha_nacimiento').datepicker({
                locale: 'es-es',
                uiLibrary: 'bootstrap4',
                format: 'dd/mm/yyyy',
                // modal: true, header: true, footer: true,
            });
            */   
            var fechaNacimiento = $('#fecha_nacimiento'); 

            fechaNacimiento.on('change', function(e){
                // console.log("hola");
                $('#edad').val(parseInt(calcEdad(e.target.valueAsNumber)));
            });

            // Asignando valor en la propiedad fecha maxima por jquery
            fechaNacimiento.attr('max', function(){
                var fechaHoy = new Date();
                var dd = fechaHoy.getDate();
                var mm = fechaHoy.getMonth() + 1; // +1 porque se tiene en cuenta que Enero es 0

                if(dd < 10) dd = "0" + dd;
                if(mm < 10) mm = "0" + mm;

                return fechaHoy.getFullYear() + '-' + mm + '-' + dd; 
                /* Forma en que tenia antes, se resumia toda la operacion en el return, pero se ve mejor de la forma de arriba*/
                // return fechaHoy.getFullYear() + '-' + (((fechaHoy.getMonth() + 1) < 10) ? '0'+(fechaHoy.getMonth()+1) : (fechaHoy.getMonth()+1)) + '-' + ((fechaHoy.getDate() < 10) ? '0' + fechaHoy.getDate() : fechaHoy.getDate()); 
            });
            
            var fCedula = $('#cedula');
            // Evento click sobre el checkbox que indica si es menor de edad
            $('#checkMenor').on('click', function(){
                // Evaluar si el campo para cedula esta deshabilitado
                if (fCedula.attr('disabled'))
                {
                    // Si esta deshabilitado se habilita el input quitando el atributo readonly
                    fCedula.removeAttr('disabled');
                }
                else{
                    fCedula.prop('disabled','disabled');
                }
            });

            // Trabajando evento click en el boton cancelar del modal
            $('#btnCancel').on('click', function(event){
                // Previniendo que se cierre el modal
                event.preventDefault();

                // Limpiando campos
                fnClearFields();
                // Cambiando el toggle del modal
                $('#AddPaciente').modal('toggle');
            });
        });  

        function calcEdad(fechaNac){
            let fechaHoy = new Date(),
                fechaN = new Date(parseInt(fechaNac));

            /*Sumando un dia al dia de nacimiento porque el input date envia un dia anterior*/
            fechaN.setDate(fechaN.getDate() + 1);

            // Obteniendo la diferencia de tiempo en milisegundos entre las 2 fechas
            let difMs = fechaHoy.getTime() - fechaN.getTime();

            // Como lo tenia antes pero daba error
            /* let añosTranscurrido = difMs / 1000 / 60 / 60 / 24 / 365; */

            // Se crea una nueva instancia del objeto Date a partir de los milisegundos obtenidos
            let fechaDif = new Date(difMs); 

            // Aun no entiendo porque se debe restar 1970 al año UTC de la fecha obtenida de la diferencia de tiempo entre las fechas
            // Pero da bien el resultado de la diferencia de años
            return Math.abs(fechaDif.getUTCFullYear() - 1970);
        }

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
                    {data:'id_historia_clinica'},
                    {data:'paciente'},
                    {data:'fecha_registro'},
                    {data:'opciones', name:"opciones", orderable:false, searchable: false, width:"15%"}
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
            // $.ajax({
            //     type: 'GET',
            //     dataType: 'json',
            //     url: 'historias-clinicas/all',
            //     // Obteniendo todas las historias clinicas
            //     success: function(data){
            //         console.log(data);
            //         // Recorriendo cada historia clinica para determinar el paciente
            //         $.each(data, function(key, hclinica){
            //             // console.log(hclinica.id_paciente);
            //             // Peticion AJAX para obtener el paciente de determinada historia clinica
            //             $.ajax({
            //                 type:'GET',
            //                 dataType: 'json',
            //                 url:`{{url('historias-clinicas/gethistoria/${hclinica.id_historia_clinica}')}}`,
            //                 success: function(response1){
            //                     // console.log(response1.nombre);
            //                     data_tr += `
            //                     <tr>
            //                         <td>${hclinica.id_historia_clinica}</td>
            //                         <td>${response1.nombre} ${response1.apellido}</td>
            //                         <td>${hclinica.fecha_registro}</td>
            //                         <td></td>
            //                     </tr>`;
            //                     $('.dataTable > tbody').html(data_tr);
            //                 }
            //             });
            //         })
            //     },
            //     error: function(jqXHR, textStatus, errorThrown){
            //         console.log('Error: ' + jsXHR + '\n Error string: ' + textStatus + '\n Error Throwed: ' + errorThrown);
            //         // console.log(response);
            //     }
            // });
        }   
        function fnStore(){
            var sendData = {
                nombres:$('#nombre').val(),
                apellidos:$('#apellido').val(),
                fecha_nacimiento:$('#fecha_nacimiento').val(),
                edad:parseInt($('#edad').val()),
                sexo:$('[name="sexo"]').val(),
                cedula:$('#cedula').val(),
                telefono:$('#telefono').val(),
                direccion:$('#direccion').val(),
                h_ocular:$('#h_ocular').val(),
                h_medica:$('#h_medica').val(),
                medicaciones:$('#medicaciones').val(),
                alergias:$('#alergias').val(),
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
                // error:function(result){
                //     if(result.responseJSON.errors){
                //         console.log('Hay errores en los campos');
                //     }
                //     console.log(result.responseJSON.errors);
                // }
            });   
        }
        function fnClearFields(){
            $('#nombre').val("");
            $('#apellido').val("");
            $('#fecha_nacimiento').val("");
            $('#edad').val("");
            $('#cedula').val("");
            $('#telefono').val("");
            $('#direccion').val("");
            $('#h_ocular').val("");
            $('#h_medica').val("");
            $('#medicaciones').val("");
            $('#alergias').val("");
        } 
        $('#jornadas').on('change',function(){
            $.ajax('url',{
                type:'get',
                dataType:'json',
                success:function(data, status, jqXHR){
                    $('#id_fecha_input').val(data.fecha_jornada);
                },
                error:(jqXHR, statusText, errorThrown)=>{
                    console.log('Error:: '+errorThrown);
                    console.log('Status:: '+statusText);
                    console.log('jqXHR Object: \n');
                    console.log(jqXHR);
                }
            });
        });
    </script>
    
    <script>
        $(function(){
            var form = $('#hclinica_form').show();

            form.steps({
                /*Apariencia*/
                headerTag: 'h3',
                bodyTag: 'fieldset',
                transitionEffect: 'slideLeft',

                /*Etiquetas*/
                labels:{
                    cancel: 'Cancelar',
                    current: 'Posicion Actual:',
                    finish: 'Registrar',
                    previous: 'Anterior',
                    next: 'Siguiente',
                    loading: 'Cargando ...'
                },

                /*Eventos*/
                // onStepChanging:,
                // onStepChanged:,
                // onFinishing:,
                // onFinished:,
            });            
        });
    </script>
@endpush