$(document).ready(function(){
    $("#hallazgo").toggle();
    $("#checkbox12").click(function(){
        $("#hallazgo").toggle();
    });
});

$(function () {
    verConsulta();
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
        success:function (response) {
            var rows="";
            console.log(response);
            $.each(response,function (key,value) {
                console.table(response);
                rows += `<option value="${value.id_jornada_trabajo}">${value.nombre_jornada}</option>`
            });
            $('#jornadaNombres').html(rows);
        }
    })
}

/*
function setDate(){
    $.ajax({
        type:"GET",
        dataType:'json',
        url:"verfecha",
        success:function (response) {
            var rows="";
            console.log(response);

            $('#fecha').setValue(response);
        }
    })
}
*/

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
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <a href="#"  data-target="" data-toggle="" onclick='' class="btn btn-raised btn-info waves-effect">
                                                 <i class="ti-pencil-alt"></i>
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
