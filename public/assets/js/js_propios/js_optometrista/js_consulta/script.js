
//Variable global para controlar el id de la historia clinica


var id_historia = $('#historiasid').val();
var id_consulta = "";
var eVisual= "";
var eVisualp="";
var retino="";
var retinop="";
var i="0";
var tablaDP="";
var tablaALT="";

//Esto una vez cargada la pagina se ejecutara
$(function () {
    verConsulta();
    probar();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//Funcion para deshabilitar los campos**********************
function deshabilitar(){

    $('#jor').attr('disabled','disabled');
    $('#observa').attr('readonly','readonly');
    $('#hall').attr('readonly','readonly');
    $('#BotonEditar').removeAttr("hidden","hidden");
    $('#BotonDetalles').attr('hidden','hidden');
    $('#btnGuardar').attr('hidden','hidden');
    $('.editableTable').removeAttr("id");
    $('.editableTable2').removeAttr("id");
    $('#refreshAllTable').load(" #cardTables");
}
//*************************************************************


//Funcion para desactivar/activar los campos del modal
function detalle_editar() {
    if(i == 0){
        //Opcion para hacer editable los campos
        //Campos y botones ************************
        $('#jor').removeAttr("disabled","disabled");
        $('#observa').removeAttr("readonly","readonly");
        $('#hall').removeAttr("readonly","readonly");
        $('#BotonEditar').attr('hidden','hidden');
        $('#BotonDetalles').removeAttr("hidden","hidden");
        $('#btnGuardar').removeAttr("hidden","hidden");
        //****************************************

        //Tabla Ojos *******************************
        $('.editableTable').attr('id','mainTable3');
        $('#mainTable3').editableTableWidget();
        //***************************************

        //Segunda tabla ****************************
        $('.editableTable2').attr('id','mainTable4');
        $('#mainTable4').editableTableWidget();
        //****************************************

        console.log("Primer if");
        i++;
    }else{
        //Opcion para deshabilitar los campos
        //Campos y botones *************************************
        $('#jor').attr('disabled','disabled');
        $('#observa').attr('readonly','readonly');
        $('#hall').attr('readonly','readonly');
        $('#BotonEditar').removeAttr("hidden","hidden");
        $('#BotonDetalles').attr('hidden','hidden');
        $('#btnGuardar').attr('hidden','hidden');
        //*****************************************************

        //Tabla Ojos *******************************************
        $('.editableTable').removeAttr("id");
        $('.editableTable2').removeAttr("id");
        $('#refreshAllTable').load(" #cardTables");

       /* $('#mainTable4').editableTableWidget();
        $('#mainTable3').editableTableWidget();*/
        //******************************************************

        //Segunda tabla ****************************************

      /*  $( "#contentTable2" ).load( " .editableTable2" );*/
        //******************************************************

        table();

       /* $('#dp1').html(tablaDP);
        $('#alt1').html(tablaALT);*/

        console.log("Else");
        i--;
    }

}

function probar() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/idservicios",
        success: function (response) {
            //Obteniendo el id y los precios de los servicios de retinoscopia y examen visual
            eVisual = response[0].id_servicio;
            eVisualp = response[0].precio;
            retino = response[1].id_servicio;
            retinop = response[1].precio;
            console.table(response);
        },
        error:function (response) {
        }
    })
}

//Funcion para ver dentro del select las jornadas
function verJornada(){
    $.ajax({
        type:"GET",
        dataType:'json',
        url:"consulta/create/verjor",
        success:function (response) {
            var rows="";
            $.each(response,function (key,value) {
                rows += `<option value="${value.id_jornada_trabajo}">${value.nombre_jornada}</option>`
            });
            $('#jornadaNombres').html(rows);
        }
    })
}
//Funcion para mostrar en el index todas las consultas de un historia clinica
function verConsulta(){
    $('.dataTable-consulta').DataTable({
        destroy:true,
        processing:true,
        serverSide:true,
        ajax: {
            url: `getconsulta/${id_historia}`,
            type:'GET'
            // dataSrc: ''
        },
        columns:[
            {data:'id_consulta'},
            {data:'nombre_jornada'},
            {data:'fecha_jornada'},
            {data:'opciones', name:"opciones", orderable:false, searchable: false}
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


//Funcion para actualizar una consulta
function updateConsulta() {



    //Nombre Jornada
    var jornada = $('#jor').val();

    //Ojo derecho
    var esd = $('#esd1').html();
    var cd = $('#cd1').html();
    var ejd = $('#ejd1').html();
    var ad = $('#ad1').html();
    var avd = $('#avd1').html();



    //Ojo Izquierdo
    var esi = $('#esi1').html();
    var ci = $('#ci1').html();
    var eji = $('#eji1').html();
    var ai = $('#ai1').html();
    var avi = $('#avi1').html();

    //D.P y ALT
    var dp = $('#dp1').html();
    var alt = $('#alt1').html();


    //Observaciones
    var obser = $('#observa').val();

    //If para validar si se va a hacer retinoscopia


    if(!($.trim($('#hall').val()).length === 0))
    {
        var hallazgo = $('#hall').val();
        //Variable para enviar los valores que se necesitan en la tabla consulta
        var dataExamen = {id_historia_clinica:id_historia,id_jornada_trabajo:jornada,
            id_servicio:[eVisual,retino],hallazgos:hallazgo,
            distancia_pupilar:dp,alt:alt,observacion:obser,
            esfera:[esd,esi],cilindro:[cd,ci],eje:[ejd,eji],adicion:[ad,ai],agudeza_visual:[avd,avi],
            _method:$('input[name=_method]').val()
        };
        console.log("entro a la mierda de retinoscopia");
    }else{
        var dataExamen = {id_historia_clinica:id_historia,
           /* id_servicio:[eVisual],*/
            distancia_pupilar:dp,alt:alt,observacion:obser,
            esfera:[esd,esi],cilindro:[cd,ci],eje:[ejd,eji],adicion:[ad,ai],agudeza_visual:[avd,avi],
            _method:$('input[name=_method]').val()
        };
    }

    console.table(dataExamen);
    $.ajax({
        type:'POST',
      /*  dataType:'json',*/
        data:dataExamen,
        url:'/historias-clinicas/consulta/'+ $("#idconsulta").val(),
        success:function (result) {
            verConsulta()
            console.log("bueno volvi")
            console.log(result);
        },error:function (result) {
            verConsulta();
            console.log("volvi")
            console.log(result);
        }
    })
}

//Funcion para ver los detalles de una consulta
function verDetalles($id){

    id_consulta = $id;
   //*******************************************************************
    //Esto sirve para desactivar los campos cada vez que se inicie
    deshabilitar();
    //*******************************************************************


    //Ojo derecho
    $('#esd1').html(" ");
    $('#cd1').html(" ");
    $('#ejd1').html(" ");
    $('#ad1').html(" ");
    $('#avd1').html(" ");

    //Ojo Izquierdo
    $('#esi1').html(" ");
    $('#ci1').html(" ");
    $('#eji1').html(" ");
    $('#ai1').html(" ");
    $('#avi1').html(" ");

    //D.P y ALT
    $('#dp1').html(" ");
    $('#alt1').html(" ");

    $('#observa').val(" ");
    $('#hall').html(" ");
    //*************************************************************
    $.ajax({
        type:"GET",
        dataType:'json',
        url:"consulta/create/verjor",
        success:function (response) {
            var rows="";
            $.each(response,function (key,value) {
                rows += `<option value="${value.id_jornada_trabajo}">${value.nombre_jornada}</option>`
            });
            $('#jor').html(rows);
        }
    })

    $.ajax({
        type:"GET",
        dataType:'json',
        url:"/historias-clinicas/consulta/"+$id,
        success:function (response) {

          /*  //Fecha
           $('#fe').val(response.consulta[0].fecha);*/

            console.log(response.consulta[0].nombre_jornada);
            $("#jor").val(response.consulta[0].id_jornada_trabajo).trigger("change");

            $("#idconsulta").val($id);

            //Ojo derecho
            $('#esd1').html(response.examen[0].esfera);
            $('#cd1').html(response.examen[0].cilindro);
            $('#ejd1').html(response.examen[0].eje);
            $('#ad1').html(response.examen[0].adicion);
            $('#avd1').html(response.examen[0].agudeza_visual);

            //Ojo Izquierdo
            $('#esi1').html(response.examen[1].esfera);
            $('#ci1').html(response.examen[1].cilindro);
            $('#eji1').html(response.examen[1].eje);
            $('#ai1').html(response.examen[1].adicion);
            $('#avi1').html(response.examen[1].agudeza_visual);

            //D.P y ALT
            $('#dp1').html(response.examen[0].distancia_pupilar);
            $('#alt1').html(response.examen[0].alt);


            //Observaciones
            $('#observa').val(response.examen[0].observacion);


        if(response.retinoscopia[0] != null){
            //Retinoscopia
            $('#hall').html(response.retinoscopia[0].hallazgos);
            /*$('#textarea').removeAttr("hidden");*/
            /*$("#hall").toggle();*/
          /*  $('#checkbox14').prop('checked','checked');*/
        }else {
            $('#hall').html(" ");
        }

        },error:function (response) {
            console.log("hay un error");
        }

    })
}

function table(){
    $.ajax({
        type:"GET",
        dataType:'json',
        url:"/historias-clinicas/consulta/"+id_consulta,
        success:function (response) {
            //Ojo derecho
            $('#esd1').html(response.examen[0].esfera);
            $('#cd1').html(response.examen[0].cilindro);
            $('#ejd1').html(response.examen[0].eje);
            $('#ad1').html(response.examen[0].adicion);
            $('#avd1').html(response.examen[0].agudeza_visual);

            //Ojo Izquierdo
            $('#esi1').html(response.examen[1].esfera);
            $('#ci1').html(response.examen[1].cilindro);
            $('#eji1').html(response.examen[1].eje);
            $('#ai1').html(response.examen[1].adicion);
            $('#avi1').html(response.examen[1].agudeza_visual);

            //D.P y ALT
            console.log("prueba para ver si se imprime");
            console.log(response.examen[0].distancia_pupilar,response.examen[0].alt)


            $('#dp1').html(response.examen[0].distancia_pupilar);
            $('#alt1').html(response.examen[0].alt);

        },error:function (response) {
            console.log("hay un error");
        }

    })
}


//Funcion para eliminar una consulta
function delData(id) {
    swal({
        title: "¿Esta seguro que eliminar esta Consulta?",
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
                    url: '/historias-clinicas/consulta/' + id,
                    success: function (response) {
                        verConsulta();
                    },
                    error: function (response) {
                        verConsulta();
                    }
                })

                swal("La Consulta fue eliminado.", {
                    icon: "success",
                });
            } else {
                swal("Accion cancelada");
                buttons: ["Aceptar"];
            }
        });


}
