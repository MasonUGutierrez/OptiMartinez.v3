
//Variable global para controlar el id de la historia clinica


var id_historia = $('#historiasid').val();
var eVisual= "";
var eVisualp="";
var retino="";
var retinop="";


//Esto una vez cargada la pagina se ejecutara
$(function () {
    //Esto es para activar y desactivar checkbox
    $("#hall").toggle();
    $("#checkbox14").click(function(){
        $("#hall").toggle();
    });
    verConsulta();
    verNF();
    probar();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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
    if($('#hall').val()!=null)
    {
        var hallazgo = $('#hall').val();
        //Variable para enviar los valores que se necesitan en la tabla consulta
        var dataExamen = {id_historia_clinica:id_historia,id_jornada_trabajo:jornada,
            id_servicio:[eVisual,retino],hallazgos:hallazgo,
            distancia_pupilar:dp,alt:alt,observacion:obser,
            esfera:[esd,esi],cilindro:[cd,ci],eje:[ejd,eji],adicion:[ad,ai],agudeza_visual:[avd,avi],
            _method:$('input[name=_method]').val()
        };

    }else{
        var dataExamen = {id_historia_clinica:id_historia,
            id_servicio:[eVisual],
            distancia_pupilar:dp,alt:alt,observacion:obser,
            esfera:[esd,esi],cilindro:[cd,ci],eje:[ejd,eji],adicion:[ad,ai],agudeza_visual:[avd,avi],
            _method:$('input[name=_method]').val()
        };
    }

    console.table(dataExamen);
    $.ajax({
        type:'POST',
        dataType:'json',
        data:dataExamen,
        url:'consulta/'+ $("#idconsulta").val(),
        success:function (result) {
            verConsulta()
            console.log(result);
        },error:function (result) {
            verConsulta();
            console.log(result);
        }
    })
}

//Funcion para ver los detalles de una consulta
function verDetalles($id){
    $('#textarea').attr("hidden","hidden");

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
        url:"consulta/"+$id,
        success:function (response) {

            //Fecha
           $('#fe').val(response.consulta[0].fecha);

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
            $('#textarea').removeAttr("hidden");
            $("#hall").toggle();
            $('#checkbox14').prop('checked','checked');
        }else {
            $('#hall').html(" ");
        }

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
