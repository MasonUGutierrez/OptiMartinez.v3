@extends('layout.master')
@section('title', 'Page Blank')
@section('parentPageTitle', 'Pages')
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
                <div class="" id="calendar">
                </div>
            </div></div>
        <div class="card">
            <div class="header">
                <h2>Listado de<strong> Jornadas</strong>
                    <span class="d-inline-block pl-3" tabindex="0" data-toggle="tooltip" data-placement="top" title="Nueva Jornada">
                        <a href="#" data-toggle="modal" onclick="activarSelect()" data-target=".newJornada" class="btn btn-raised btn-success waves-effect waves-light"><i class="zmdi zmdi-gps-dot"></i></a>
                    </span>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover dataTable-jornada theme-color mb-0">
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
@include('optometrista.jornadas.add-jornada')
@include('optometrista.jornadas.edit-jornada')
@include('optometrista.jornadas.modal-calendar')
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

        function verDepartamento(){
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
                }
            })
        }

        function verTipoJornadas(){
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
                }
            })
        }
        function guardarJornada() {
            var tipojornada = $('#tipoJornadaID').val();
            var departamento = $('#departamentoID').val();
            var nombre = $('#nombreJornadaID').val();
            var lugar = $('#direccionJornadaID').val();
            var fechaInicio = $('#fechaInicio').val();
            var horaInicio = $('#horaInicio').val();
            var fechaFinal = $('#fechaFinal').val();
            var horaFinal= $('#horaFinal').val();
            /*var colorFondo = $('#colorPicker').val();*/

            var data = {id_jornada:tipojornada,id_departamento:departamento,nombre_jornada:nombre,lugar:lugar,fecha_jornada:fechaInicio,fecha_final:fechaFinal,
                        hora_inicio:horaInicio,hora_final:horaFinal};
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
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale:'es',
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
                        $('#exampleModal').modal('toggle');
                      }
                  }
                },
                dateClick:function(info){
                    $('#exampleModal').modal('toggle');
                    $('#fechaInicio').val(info.dateStr);
                    verDepartamento();
                    verTipoJornadas();
                    /*calendar.addEvent({title:"Evento X",date:info.dateStr})*/
                },
                eventClick:function(info){
                    var mes= (info.event.start.getMonth()+1<10)?"0"+(info.event.start.getMonth()+1):info.event.start.getMonth()+1;

                    var fecha=  info.event.start.getFullYear() +"-"+mes+"-"+info.event.start.getDate();

                    $('#exampleModal').modal('toggle');
                    $('#tituloModal').val(info.event.title);
                    $('#descripcionModal').val(info.event.extendedProps.descripcion);
                    $('#fechaInicio').val(fecha);
                    $('#fechaEnd').val(info.event.endStr);
                    $('#colorModal').val(info.event.color);



                    console.log(info.event);
                },
               /* events:[
                    {
                        title:"Evento 1",
                        start:"2020-07-22 12:30:00",
                        descripcion:"Probando la descripcion del evento 1"
                    },
                    {
                        start:"2020-07-24 12:30:00",
                       title:"Evento 2",

                        descripcion:"Probando la descripcion del evento 2"
                    },
                    {
                        title: 'All Day Event',
                            start: '2020-08-01'
                    }

                ],*/

                events:"{{url('/calendar')}}",

                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                /*editable: true,*/
                selectable: true
            });
            calendar.render();

            $('#btnprueba').click(function () {
               /* recolectarDatos("POST");*/
                /*window.location.href="{{url('/calendar')}}";*/
            })

             function recolectarDatos(method) {
                 nuevoEvento={
                     nombre_jornada:$('#nombreJornadaID').val(),
                     lugar:$('#direccionJornadaID').val(),
                     fecha_jornada:$('#fechaInicio').val(),
                     fecha_final:$('#fechaFinal').val(),
                     color_fondo:$('#colorPicker').val(),
                     color_texto:'#FFFFFF',
                 }
                console.log(nuevoEvento);

             }

        });
    </script>
@endpush
