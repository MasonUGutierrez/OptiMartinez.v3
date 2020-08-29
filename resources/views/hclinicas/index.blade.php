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

            initValidateStep();

            // Limpiando los errores de todas las ventanas steps si se cierra el modal
            $('#AddPaciente').on('hide.bs.modal', function(){
                var form = $('#hclinica_form');
                form.find($('.current')).removeClass('error');

                form.validate().resetForm(); // Reseteando los errores
                setAnanmesisFields(); // Seteando los valores en los campos de Ananmesis

                /*
                  Validacion para deschequear el input que indica 
                  si tiene cedula o no
                */               
                var initial = $('#checkCedula').is(':checked');
                if (initial && isEmpty($('#edad').val())){
                    $('#cedula').prop('disabled', false);
                    $('#cedObl').show();
                    $('#checkCedula').prop('checked', false)
                                     .prop('disabled', false);                 
                } 
            });

            // Evento keyup para ocultar el check de cedula si empieza a escribir una
            $('#cedula').on('keyup', function(){
                if(isEmpty($(this).val())){
                    $('#checkContainer').show();
                }
                else{
                    $('#checkContainer').hide();
                }
            });
            $('#AddPaciente').on('shown.bs.modal', function(){
                if($('#checkContainer').is(':hidden') && isEmpty($('#cedula').val())){
                    $('#checkContainer').show(); 
                }
            });
            /* $('#AddPaciente').on('shown.bs.modal', function(){
                var initial = $('#checkCedula').is(':checked');

                if (initial){
                    $('#cedula').prop('disabled', false);
                    $('#cedObl').show();
                    $('#checkCedula').prop('checked', false);                 
                } 
            }); */

            var fechaNacimiento = $('#fecha_nacimiento'); 
            
            // Evento change en el input fechaNacimiento para setear el valor al input edad
            fechaNacimiento.on('change', function(e){
                $('#edad').val(parseInt(calcEdad(e.target.valueAsNumber)));
            });

            // Evento blur(perder focus) en el input de fechaN.. para automaticamente 
            // chequear que no tiene cedula por tener una edad no permitida
            fechaNacimiento.on('blur', function(e){
                console.log(!isEmpty($('#edad').val()));
                // Number() convierte una "" a 0, parseInt() la convierte en NaN
                if(parseInt($('#edad').val()) < 16){
                    $('#checkCedula').prop('checked', true)
                                     .prop('disabled', true);
                    $('#cedula').prop('disabled', true);
                    $('#cedObl').hide();
                }
                else{
                    $('#checkCedula').prop('checked', false)
                                     .prop('disabled', false);
                    $('#cedula').prop('disabled', false);
                    $('#cedObl').show();
                }
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
            
            // Evento click sobre el checkbox que indica si es menor de edad
            $('#checkCedula').on('click', function(){
                var input = $('#cedula'), 
                    labelRequired = $('#cedObl');

                if($(this).is(":checked")){                    
                    labelRequired.hide(); // document.querySelector("#cedObl").style.display = "none";
                    input.prop('disabled', true);
                    input.val("");

                    // Quitando los errores lanzados por form.validate();
                    input.removeClass("error");
                    $("#cedula + label.error").remove();
                }
                else{                    
                    labelRequired.show(); // document.querySelector("#cedObl").style.display = "inline";
                    input.prop('disabled', false);
                }
            });
            // Trabajando evento click en el boton cancelar del modal
            /* $('#btnCancel').on('click', function(event){
                // Previniendo que se cierre el modal
                event.preventDefault();

                // Limpiando campos
                fnClearFields();
                // Cambiando el toggle del modal
                $('#AddPaciente').modal('toggle');
            }); */

            setAnanmesisFields();            
        });
        
        // Funcion para setear los valores en los inputs del apartado Ananmesis
        function setAnanmesisFields(){
            //Evento blur(perder focus) en los campos de Ananmesis         
            $('#h_ocular, #h_medica, #medicaciones, #alergias').on('blur', function(){
                if(isEmpty($(this).val())) $(this).val("N/A")
            });
            //Evento focus en los campos de Ananmesis para que borre el valor si esta en N/A
            $('#h_ocular, #h_medica, #medicaciones, #alergias').on('focus', function(){
                if($.trim($(this).val()) == "N/A") $(this).val("")
            });
            //Seteando el valor por defecto N/A en los campos seleccionados por IDs
            $("#h_ocular, #h_medica, #medicaciones, #alergias").val("N/A");
        }

        // Funcion para las librerias validate() y steps()
        function initValidateStep(){
            var form = $('#hclinica_form').show();
            form.validate({
                rules: {
                    nombres:{
                        minlength: 3,
                        required: true,
                    },
                    apellidos:{
                        required: true,
                        minlength: 4,
                    },
                    fecha_nacimiento:{
                        required: true,
                        date: true,
                    },
                    edad:{
                        required:{
                            depends: function(element){
                                return isEmpty($('#fecha_nacimiento').val());
                            }
                        },
                        number: true,
                    },
                    sexo:{
                        required: true,
                        minlength: 1
                    },
                    cedula:{
                        minlength:14,
                        maxlength:16,
                        required:{
                            depends: function(element){
                                // var isChecked = $('#checkCedula').is(':checked');
                                // return !isChecked;
                                // Si esta checkeado entonces no es requerido el campo cedula
                                return $('#checkCedula').is(':checked') ? false : true;
                            }
                        }
                    },
                    telefono:{
                        minlength: 8,
                        maxlength: 15,
                        validPhone: true,
                        required:true,
                    },
                    direccion:{
                        minlength: 4, // minimo de 4 caracteres por el nombre mas pequeño de departamento  
                    },
                    h_ocular:{
                        minlength:3
                    },
                    h_medica:{
                        minlength:3
                    },
                    medicaciones:{
                        minlength:3
                    },
                    alergias:{
                        minlength:3
                    }
                }
            });

            // Creando regla propia de validacion
            jQuery.validator.addMethod('validPhone', function(value, element){
                var pattern = /^(([\+]+(505)+){0,1}|([(]+(505)+[)]+){0,1})(\s|[-])?[^0-1]{1}[0-9]{3}(\s|[-])?\d{4}$/;
                
                return this.optional(element) || pattern.test(value);
            }, "Por favor, ingrese un número telefónico válido");  

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
                onStepChanging: function(event, currentIndex, newIndex){
                    // Permitir que se mueva la pestaña anterior aunque el formulario no sea valido
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // En caso que el usuario regrese a la pagina siguiente donde el formulario daba error, se limpian las notificaciones de error
                    if (currentIndex < newIndex)
                    {
                        // Limpiando los errores en el formulario
                        form.find('.body:eq(' + newIndex + ') label.error').remove();
                        form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
                    }
                    form.validate();
                    return form.valid();
                },
                // onStepChanged: function (event, currentIndex, priorIndex) {
                //     console.log("estas en: " + currentIndex + "\nVienes de: " + priorIndex);
                //     // if(currentIndex == 2)
                //     // Nota: Los steps se inicializan en 0
                // },
                onFinishing: function(event, currentIndex){
                    form.validate();
                    return form.valid();
                },
                onFinished: function(event, currentIndex){
                    // console.log(event);
                    fnStore();
                    swal({
                        title: "Enhorabuena",
                        text: "Historia clinica registrada",
                        icon:'success',
                    }).then(()=>{
                        $("#AddPaciente").modal('toggle');
                        fnClearFields();
                        form.steps('reset');
                    });
                },
            });             
        }       

        // Funcion para determinar si una str es vacia
        function isEmpty(str){
            // Validar si es una cadena vacia y sin espacios en blanco
            return ($.trim(str).length === 0) ? true : false;
        }

        // Funcion para determinar la edad basado en una fecha de nacimiento
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

        /* $('#Guardar').on('click', function(event){
            event.preventDefault();
            fnStore();
        }); */

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
                sexo:$('[name="sexo"]:checked').val(),
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
                    console.log(datas.nombres + ' Registrado!!');
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
            $('#maleRadio').prop('checked', true);
            $('#cedula').val("");
            $('#telefono').val("");
            $('#direccion').val("");
            $('#h_ocular').val("");
            $('#h_medica').val("");
            $('#medicaciones').val("");
            $('#alergias').val("");
        } 
    </script>
@endpush
