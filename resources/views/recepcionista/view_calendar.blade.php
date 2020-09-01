@extends('layout.master')
{{--@section('parentPageTitle', 'Pages')--}}
@section('title', 'Jornadas')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
    <!--Estilo FullCalendar -->
    <link rel="stylesheet" href="{{asset('assets/fullcalendar/lib/main.css')}}">
    {{-- Estilos para Datatable --}}
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
    <style>

        body {
            margin: 40px 10px;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 1100px;
            margin: 0 auto;
        }

    </style>
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <ul class="nav nav-tabs p-0">
                        <li class="nav-item">
                            <a href="#calendario" id="btn-activos" class="nav-link active" data-toggle="tab">Calendario de Jornadas</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tablaJornada" id="btn-inactivos" class="nav-link" data-toggle="tab">Listado de Jornadas</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="body" id="bodyCalendar">
                    <div class="tab-content">
                        <div class="tab-pane in active" role="tabpanel" id="calendario">
                            <div class="" id="calendar">
                            </div>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="tablaJornada">
                            <div class="header">
                                <input type="hidden" name="_method" value="PUT">
                                <h2>Listado de<strong> Jornadas</strong>
                                    <span class="d-inline-block pl-3" tabindex="0" data-toggle="tooltip" data-placement="top" title="Nueva Jornada">
                                <a href="#" data-toggle="modal" onclick="activarSelect()" data-target=".newJornada" class="btn btn-raised btn-success waves-effect waves-light"><i class="zmdi zmdi-gps-dot"></i></a>
                            </span>
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-hover dataTable-jornada theme-color mb-0" width="100%">
                                        <thead>
                                        <tr style="text-align: center">
                                            <th>Nombre</th>
                                            <th style="text-align: center">Tipo</th>
                                            <th style="text-align: center">Fecha</th>
                                            <th>Lugar</th>
                                            <th>Departamento</th>
                                            <th>Opciones</th>
                                        </tr>
                                        </thead>

                                        <tbody id="tabla">
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="card">


             </div>--}}
        </div>
    </div>
    @include('optometrista.jornadas.add-jornada')
    @include('optometrista.jornadas.edit-jornada')
    @include('recepcionista.modal-calendar')
    @include('optometrista.jornadas.modal-calendarNew')
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    {{-- Scripts para DataTable --}}
    <script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
    {{-- Scripts para los botones de jqueryDataTable --}}
    <script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
@stop
@push('after-scripts')
    <script src="{{asset('assets/js/pages/ui/sweetalert.js')}}"></script>
    <script src="{{asset('assets/plugins/momentjs/moment.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
    <script src="{{asset('assets/fullcalendar/lib/main.js')}}"></script>
    <script src="{{asset('assets/fullcalendar/lib/locales-all.js')}}"></script>
    {{--
        <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
    --}}
    <script src="{{asset('assets/js/js_propios/js_optometrista/js_jornada/script.js')}}"></script>
    <script>


        function verDepartamento(id){
            $.ajax({
                type:"GET",
                dataType:'json',
                url:"depas",
                success:function (response) {
                    var rows="";
                    $.each(response,function (key,value) {
                        rows += `<option value="${value.id_departamento}">${value.departamento}</option>`
                    });
                    $('#departamentoID').html(rows);
                    $('#departamentoID2').html(rows);
                },
                complete:function (){
                    if (id){
                        $('#departamentoID').val(id).trigger("change");
                    }
                }
            })

        }
        function verTipoJornadas(id){
            $.ajax({
                type:"GET",
                dataType:'json',
                url:"vertipos",
                success:function (response) {
                    var rows="";
                    $.each(response,function (key,value) {
                        rows+= `<option value="${value.id_jornada}">${value.tipo_jornada}</option>`
                    });
                    $('#tipoJornadaID').html(rows);
                    $('#tipoJornadaID2').html(rows);
                },
                complete:function (){
                    if (id){
                        $('#tipoJornadaID').val(id).trigger("change");
                    }
                }
            })
        }
        function guardarJornada() {
            var tipojornada = $('#tipoJornadaID2').val();
            var departamento = $('#departamentoID2').val();
            var nombre = $('#nombreJornadaID2').val();
            var lugar = $('#direccionJornadaID2').val();
            var fechaInicio = $('#fechaInicio2').val();
            var horaInicio = $('#horaInicio2').val();
            /*var fechaFinal = $('#fechaFinal').val();
            var horaFinal= $('#horaFinal').val();*/
            /*var colorFondo = $('#colorPicker').val();*/

            var data = {id_jornada:tipojornada,id_departamento:departamento,nombre_jornada:nombre,lugar:lugar,fecha_jornada:fechaInicio,/*fecha_final:fechaFinal,*/
                hora_inicio:horaInicio/*,hora_final:horaFinal*/};
            console.log(data);
            $.ajax({
                type:'post',
                dataType:'json',
                data:data,
                url:'jornadas',
                success:function (result) {
                },error:function (result) {

                }
            })

        }
        function actualizarJornada() {
            var tipojornada = $('#tipoJornadaID').val();
            var departamento = $('#departamentoID').val();
            var nombre = $('#nombreJornadaID').val();
            var lugar = $('#direccionJornadaID').val();
            var fechaInicio = $('#fechaInicio').val();
            var horaInicio = $('#horaInicio').val();

            var data = {id_jornada:tipojornada,id_departamento:departamento,nombre_jornada:nombre,lugar:lugar,fecha_jornada:fechaInicio,/*fecha_final:fechaFinal,*/
                hora_inicio:horaInicio,_method:$('input[name=_method]').val()/*,hora_final:horaFinal*/};
            console.log(data);
            $.ajax({
                type:'post',
                data:data,
                url:'jornadas/' + $('#id_jornada_trabajo').val(),
                success:function (datas,status,jqxhr) {
                    console.log("Nice");
                    console.log(datas);
                    console.log(jqxhr);

                },error:function (jqxhr,status,error) {
                    console.log("bad");
                    console.log(jqxhr);
                    console.log(status);
                    console.log(error);
                }
            })

        }
        function limpiarmodal(){
            $('#nombreJornadaID').val("");
            $('#direccionJornadaID').val("");
            $('#fechaInicio').val("");
            $('#horaInicio').val("");
            $('#nombreJornadaID2').val("");
            $('#direccionJornadaID2').val("");
            $('#fechaInicio2').val("");
            $('#horaInicio2').val("");
        }
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                slotLabelFormat:{
                    hour: 'numeric',
                    minute: '2-digit',
                    omitZeroMinute:true,
                    meridiem: 'narrow',
                    hour12: true
                },//se visualizara de esta manera 01:00 AM en la columna de horas
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    omitZeroMinute: true,
                    meridiem: 'narrow',
                    hour12: true
                },
                locale:'es',
                firstDay:0,
                headerToolbar: {
                    left: 'prev,next today probandoBoton',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                //Para agregar botones personalizados en este caso el "probandoBoton" el cual, al ser pulsado muestra un modal
                customButtons: {
                    probandoBoton:{
                        text:"Nuevo",
                        click:function () {
                            limpiarmodal();
                            $('#calendarModalNew').modal('toggle');
                            $('#horaInicio2').val("");
                            verDepartamento();
                            verTipoJornadas();
                        }
                    }
                },
                dateClick:function(info){
                    limpiarmodal();
                    $('#calendarModalNew').modal('toggle');
                    $('#fechaInicio2').val(info.dateStr);
                    verDepartamento();
                    verTipoJornadas();
                    /*calendar.addEvent({title:"Evento X",date:info.dateStr})*/
                },
                eventClick:function(info){
                    /*var mes= (info.event.start.getMonth()+1<10)?"0"+(info.event.start.getMonth()+1):info.event.start.getMonth()+1;*/

                    var dd = info.event.start.getDate();
                    var mm = info.event.start.getMonth() + 1; // +1 porque se tiene en cuenta que Enero es 0

                    if(dd < 10) dd = "0" + dd;
                    if(mm < 10) mm = "0" + mm;

                    var fecha=  info.event.start.getFullYear() +"-"+mm+"-"+dd;
                    limpiarmodal();

                    $('#exampleModal').modal('toggle');
                    $('#nombreJornadaID').val(info.event.title);
                    $('#direccionJornadaID').val(info.event.extendedProps.descripcion);
                    $('#fechaInicio').val(fecha);
                    $('#horaInicio').val(info.event.extendedProps.hora);
                    $('#id_jornada_trabajo').val(info.event.id);
                    verDepartamento(info.event.extendedProps.id_departamento);
                    verTipoJornadas(info.event.extendedProps.id_jornada);

                    botonCancelar();
                    console.log(info.event);
                },

                events:"{{url('/calendar')}}",

                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                /*editable: true,*/
                selectable: true
            });
            calendar.render();
            function deleteData() {
                swal({
                    title: "¿Esta seguro que eliminar esta Jornada?",
                    text: "Una vez eliminada no será capaz de recuperarla!",
                    icon: "warning",
                    buttons: ["Cancelar", "Eliminar"],
                    /*buttons: true,*/
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "DELETE",
                                dataType: "json",
                                url: 'jornadas/' + $('#id_jornada_trabajo').val(),
                                success: function (response) {
                                },
                                error: function (response) {
                                }
                            })

                            swal("La jornada fue eliminado.", {
                                icon: "success",

                            }).then(()=>{calendar.refetchEvents();});
                        } else {
                            swal("Accion cancelada");
                            buttons: ["Aceptar"];
                        }
                    });


            }

            $("#btnpruebas").on("click",function (e){
                e.preventDefault();
                actualizarJornada();
                calendar.refetchEvents();
                $('#exampleModal').modal('toggle');
            });
            $("#btnpruebas2").on("click",function (e){
                e.preventDefault();
                guardarJornada();
                calendar.refetchEvents();
                $('#calendarModalNew').modal('toggle');

            });
            $('#delButton').on("click",function (e){
                e.preventDefault();
                deleteData();
                calendar.refetchEvents();
                $('#exampleModal').modal('toggle');
            })
            $('#btnEditar').on("click",function (e){
                botonEditar();
            })
            $('#cancelButton').on("click",function (e){
                botonCancelar();
            })

        });
        function botonEditar(){
            $('#btnEditar').attr('hidden','hidden');
            $('#btnpruebas').removeAttr('hidden','hidden');
            $('#tipoJornadaID').removeAttr('disabled','disabled');
            $('#departamentoID').removeAttr('disabled','disabled');
            $('#nombreJornadaID').removeAttr('readonly','readonly');
            $('#direccionJornadaID').removeAttr('readonly','readonly');
            $('#fechaInicio').removeAttr('readonly','readonly');
            $('#horaInicio').removeAttr('readonly','readonly');
            $('#cancelButton').removeAttr('hidden','hidden');
            $('#closeButton').attr('hidden','hidden');
            $('#delButton').attr('hidden','hidden');
        }
        function botonCancelar(){
            $('#btnEditar').removeAttr('hidden','hidden');
            $('#btnpruebas').attr('hidden','hidden');
            $('#tipoJornadaID').attr('disabled','disabled');
            $('#departamentoID').attr('disabled','disabled');
            $('#nombreJornadaID').attr('readonly','readonly');
            $('#direccionJornadaID').attr('readonly','readonly');
            $('#fechaInicio').attr('readonly','readonly');
            $('#horaInicio').attr('readonly','readonly');
            $('#cancelButton').attr('hidden','hidden');
            $('#closeButton').removeAttr('hidden','hidden');
            $('#delButton').removeAttr('hidden','hidden');
        }
    </script>
@endpush
