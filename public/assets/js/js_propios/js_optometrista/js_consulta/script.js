
//Variable global para controlar el id de la historia clinica
var id_historia = "2";
var eVisual= "";
var eVisualp="";
var retino="";
var retinop="";


//Esto una vez cargada la pagina se ejecutara
$(function () {
    //Esto es para activar y desactivar checkbox
    $("#hallazgo").toggle();
    $("#checkbox12").click(function(){
        $("#hallazgo").toggle();
    });

    $("#hall").toggle();
    $("#checkbox14").click(function(){
 e();
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
        url:"verjor",
        success:function (response) {
            var rows="";
            $.each(response,function (key,value) {
                rows += `<option value="${value.id_jornada_trabajo}">${value.nombre_jornada}</option>`
            });
            $('#jornadaNombres').html(rows);
        }
    })
}

/*


Con este if se puede saber si es presionado e
if(document.getElementById('button').clicked == true)
{
   alert("button was clicked");
}



*/

//Funcion para mostrar el nombre del paciente y la fecha dentro del modal nueva consulta
function verNF(){
    $.ajax({
        type:"GET",
        dataType:'json',
        url:"getconsulta",
        success:function (response) {
            $nombres = response[0].nombre + " " + response[0].apellido;
            $('#nombreCliente').val($nombres);
            $('#fecha').val(response[0].fecha_jornada);
        }

    })
}

//FUncion para guardar los precios de los servicios dentro de variables globales
function probar() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "idservicios",
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

//Funcion para mostrar en el index todas las consultas de un historia clinica
function verConsulta(){
    $.ajax({
        type: "GET",
        dataType: "json",
        /*Poner el URL de la funcion que tiene el getAll que devuelve los datos*/
        url: "getconsulta",
        success: function (response) {
            var rows = "";

            $.each(response, function (key, value) {
                rows += `
                                <tr style="text-align: center">
                                        <td>${value.id_consulta}</td>
                                        <td>${value.nombre_jornada}</td>
                                        <td>${value.fecha}</td>
                                        <td>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Detalles">
                                                <a href="consulta/${value.id_consulta}"  data-target=".showConsulta" data-toggle="modal" onclick='verDetalles(${value.id_consulta})' class="btn btn-raised btn-info waves-effect">
                                                 <i class="ti-pencil-alt"></i>
                                                </a>
                                             </span>
                                             <span class="d-inline-block" tabindex="0" data-toggle="tooltip"  data-placement="top" title="Eliminar">
                                                 <a href="#"
                                                       class="btn btn-raised btn-danger waves-effect"
                                                       data-type="confirm"
                                                       data-title="Dar de Baja"
                                                       data-text="¿Desea eliminar el registro de esta Consuta?"
                                                       data-obj="${value.nombre_jornada}"
                                                       onclick="delData(${value.id_consulta})">
                                                         <i class="ti-trash"></i>
                                                </a>
                                             </span>
                                        </td>
                                </tr>
                            `;
            });
            $('#tabla').html(rows);
        },
        error:function (response) {
            console.table(response);
        }
    })
}

//Funcion para guardar una consulta
function newConsulta() {

    //Nombre Jornada
    var jornada = $('#jornadaNombres').val();

    //Fecha
    var fecha = $('#fecha').val();

    //Ojo derecho
    var esd = $('#esd').html();
    var cd = $('#cd').html();
    var ejd = $('#ejd').html();
    var ad = $('#ad').html();
    var avd = $('#avd').html();



    //Ojo Izquierdo
    var esi = $('#esi').html();
    var ci = $('#ci').html();
    var eji = $('#eji').html();
    var ai = $('#ai').html();
    var avi = $('#avi').html();

    //D.P y ALT
    var dp = $('#dp').html();
    var alt = $('#alt').html();


    //Observaciones
    var obser = $('#observ').val();

    //If para validar si se va a hacer retinoscopia
    if($('#checkbox12').is(":checked"))
    {
        var hallazgo = $('#hallazgo').val();

        //Variable para enviar los valores que se necesitan en la tabla consulta
        var dataExamen = {id_historia_clinica:id_historia,fecha:fecha,id_jornada_trabajo:jornada,
            id_servicio:[eVisual,retino],precio:[eVisualp,retinop],hallazgos:hallazgo,
            distancia_pupilar:dp,alt:alt,observacion:obser,
            esfera:[esd,esi],cilindro:[cd,ci],eje:[ejd,eji],adicion:[ad,ai],agudeza_visual:[avd,avi]
        };

    }else{
        var dataExamen = {id_historia_clinica:id_historia,fecha:fecha,id_jornada_trabajo:jornada,
            id_servicio:[eVisual],precio:[eVisualp],
            distancia_pupilar:dp,alt:alt,observacion:obser,
            esfera:[esd,esi],cilindro:[cd,ci],eje:[ejd,eji],adicion:[ad,ai],agudeza_visual:[avd,avi]
        };
    }


    $.ajax({
        type:'post',
        dataType:'json',
        data:dataExamen,
        url:'consulta',
        success:function (result) {
            verConsulta();
        },error:function (result) {
            verConsulta();
        }
    })
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
        url:"verjor",
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
                    url: 'consulta/' + id,
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
