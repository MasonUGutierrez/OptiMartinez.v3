var id_historia = $('#ids').val();
var eVisual= "";
var eVisualp="";
var retino="";
var retinop="";




$(function () {
    //Esto es para activar y desactivar checkbox
    $("#desaparecer").toggle();
    $("#checkbox12").click(function(){
        $("#desaparecer").toggle();
    });

    $("#hall").toggle();
    $("#checkbox14").click(function(){
        e();
    });
/****************************************************/
    $('#jornadaNombres').on('change',function(){
        $.ajax({
            type:'get',
            dataType:'json',
            url:"verfecha/" + $('#jornadaNombres option:selected').val(),
            success:function(data){
                $('#FechaNewConsulta').val(data);

            },
            error:(jqXHR, statusText, errorThrown)=>{
                console.log('Error:: '+errorThrown);
                console.log('Status:: '+statusText);
                console.log('jqXHR Object: \n');
                console.log(jqXHR);
            }
        });
    });
/****************************************************/
    verJornada();
    verNF();
    probar();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function verJornada(){
    $.ajax({
        type:"GET",
        dataType:'json',
        url:"verjor",
        success:function (jornadas) {
            var rows="<option class='text-muted' selected>-- Selecciona una Jornada --</option>";
            $.each(jornadas,function (key,value) {
                rows += `<option value="${value.id_jornada_trabajo}">${value.nombre_jornada}</option>`
            });
            $('#jornadaNombres').html(rows);
        }
    })
}

function verNF(){
    $.ajax({
        type:"GET",
        dataType:'json',
        url:"verpaciente/"+ id_historia,
        success:function (response) {
            $nombres = response[0].nombres + " " + response[0].apellidos;
            $('#nombreCliente').val($nombres);
           /* $('#fecha').val(response[0].fecha_jornada);*/
        }

    })
}

function probar() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/idservicios",
        success: function (response) {
            //Obteniendo el id y los precios de los servicios de retinoscopia y examen visual

            $(response).each(function (indice,valor){
                if (valor.servicio == "Retinoscopia"){
                    retino = valor.id_servicio;
                    retinop = valor.precio;
                }else if (valor.servicio =="Examen Visual"){
                    eVisual = valor.id_servicio;
                    eVisualp = valor.precio;
                }
            })
            console.log("valores evolution");
            console.log(retino,retinop);
            console.log(eVisual,eVisualp);



            console.table(response);
        },
        error:function (response) {
        }
    })
}

function newConsulta() {

    //Nombre Jornada
    var jornada = $('#jornadaNombres').val();

    //Fecha
    var fecha = $('#FechaNewConsulta').val();;

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
    var recomendacion = $('#recomendacion').val();
    var hallazgo = $('#hallazgo').val();
    //If para validar si se va a hacer retinoscopia
    // if($('#checkbox12').is(":checked"))
    if($.trim(hallazgo).length === 0)
    {
        var dataExamen = {id_historia_clinica:id_historia,fecha:fecha,id_jornada_trabajo:jornada,
            id_servicio:[eVisual],precio:[eVisualp],
            distancia_pupilar:dp,alt:alt,observacion:obser,recomendacion_lente:recomendacion,
            esfera:[esd,esi],cilindro:[cd,ci],eje:[ejd,eji],adicion:[ad,ai],agudeza_visual:[avd,avi]
        };
    }else{
        //Variable para enviar los valores que se necesitan en la tabla consulta
        var dataExamen = {id_historia_clinica:id_historia,fecha:fecha,id_jornada_trabajo:jornada,
            id_servicio:[eVisual,retino],precio:[eVisualp,retinop],hallazgos:hallazgo,recomendacion_lente:recomendacion,
            distancia_pupilar:dp,alt:alt,observacion:obser,
            esfera:[esd,esi],cilindro:[cd,ci],eje:[ejd,eji],adicion:[ad,ai],agudeza_visual:[avd,avi]
        };
    }

    //poner pleca unicial para que no concatene la url a la url anterior
    $.ajax({
        type:'post',
        dataType:'json',
        data:dataExamen,
        url:'/historias-clinicas/consulta',
        success:function (result,status,jqXhr) {
            console.log("nice");
            // console.log(result);
            location.href="/historias-clinicas/"+id_historia;
        },error:function (result) {
            console.log("bad");
            console.log(result);
        }
    })
}
