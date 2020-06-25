$(function () {
    verJornadas();
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function verDepa(){
    $.ajax({
        type:"GET",
        dataType:'json',
        url:"depas",
        success:function (response) {
            var rows="";
            console.log(response);
            $.each(response,function (key,value) {
                console.log(value.departamento);
                rows += `<option value="${value.id_departamento}">${value.departamento}</option>`
            });
            $('#depas').html(rows);
        }
    })
}

function verTipoJornada(){
    $.ajax({
        type:"GET",
        dataType:'json',
        url:"vertipos",
        success:function (response) {
            console.log(response);
            var rows="";
            $.each(response,function (key,value) {
                rows+= `<option value="${value.id_jornada}">${value.tipo_jornada}</option>`
            });
            $('#tipojornada').html(rows);
        }
    })
}

function activarSelect() {
    verDepa();
    verTipoJornada();
}
function activarSelect2() {
    verDepa2();
    verTipoJornada2();
}

function saveJornada() {
    var nombre = $('#nombre').val();
    var tipojornada = $('#tipojornada').val();
    var fecha = $('#fecha').val();
    var lugar = $('#lugar').val();
    var departamento = $('#depas').val();
    var data = {id_jornada:tipojornada,id_departamento:departamento,nombre_jornada:nombre,lugar:lugar,fecha_jornada:fecha};
    console.log(data);
    $.ajax({
        type:'post',
        dataType:'json',
        data:data,
        url:'jornadas',
        success:function (result) {
        },error:function (result) {
            clearData();
            verJornadas();
        }
    })
}

function verJornadas(){
   /* $.ajax({
        type: "GET",
        dataType: "json",
        /!*Poner el URL de la funcion que tiene el getAll que devuelve los datos*!/
        url: "verjornadas",
        success: function (response) {
            console.log(response);
            var rows = "";
            $.each(response, function (key, value) {
                rows += `
                                <tr style="text-align: center">
                                        <td>${value.nombre_jornada}</td>
                                        <td>${value.tipo_jornada}</td>
                                        <td>${value.fecha_jornada}</td>
                                        <td>${value.lugar}</td>
                                        <td>${value.departamento}</td>
                                        <td>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <a href="jornadas/${value.id_jornada_trabajo}/edit"  data-target=".editJornada" data-toggle="modal" onclick='updateData(${value.id_jornada_trabajo})' class="btn btn-raised btn-info waves-effect">
                                                 <i class="ti-pencil-alt"></i>
                                                </a>
                                             </span>
                                             <span class="d-inline-block" tabindex="0" data-toggle="tooltip"  data-placement="top" title="Dar de Baja">
                                                 <a href="#"
                                                       class="btn btn-raised btn-danger waves-effect"
                                                       data-type="confirm"
                                                       data-title="Dar de Baja"
                                                       data-text="¿Desea eliminar el Plan de Pago: ${value.nombre_jornada} ?"
                                                       data-obj="${value.nombre_jornada}"
                                                       onclick="deleteData(${value.id_jornada_trabajo})">
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
            console.log(response);
        }
    })*/
    $('.dataTable-jornada').DataTable({
        destroy:true,
        processing:true,
        serverSide:true,
        ajax: {
            url:'verjornadas',
            type:'GET'
            // dataSrc: ''
        },
        columns:[
            {data:'nombre_jornada'},
            {data:'tipo_jornada'},
            {data:'fecha_jornada'},
            {data:'lugar'},
            {data:'departamento'},
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

function clearData() {
    $('#nombre').val("");
    $('#fecha').val("");
    $('#lugar').val("");
    $("#tipojornada").select2("val", "");
    $("#depas").select2("val", "");
}
function clearData2() {
    $('#nombre2').val("");
    $('#fecha2').val("");
    $('#lugar2').val("");
    $("#tipojornada2").select2("val", "");
    $("#depas2").select2("val", "");
}

function updateData(id_jornada_trabajo){
    activarSelect2();
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: "jornadas/" + id_jornada_trabajo + "/edit",
        success: function (response) {
            $("#nombre2").val(response[0].nombre_jornada);
            $("#fecha2").val(response[0].fecha_jornada);
            $("#lugar2").val(response[0].lugar);
            $("#tipojornada2").val(response[0].id_jornada).trigger("change");
            $("#depas2").val(response[0].id_departamento).trigger("change");
            $("#idJornada").val(response[0].id_jornada_trabajo);
        },
        error: function (result) {
            alert(result);
        }
    })
}

function saveData(){
    var nombre = $('#nombre2').val();
    var fecha = $('#fecha2').val();
    var lugar = $('#lugar2').val();
    var tipojornada = $('#tipojornada2').val();
    var depas = $('#depas2').val();
    var data = {id_jornada:tipojornada,id_departamento:depas,nombre_jornada:nombre,lugar:lugar,fecha_jornada:fecha, _method:$('input[name=_method]').val()};
    console.table(data);
    console.log($("#idJornada").val());
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: data,
        url: 'jornadas/' + $("#idJornada").val(),
        success: function (result) {
            console.log(result);
            verJornadas();
            clearData2();
        },
        error: function (result) {
            console.log(result);
            verJornadas();
            clearData2();

        }
    })
}

function deleteData(id) {
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
                    url: 'jornadas/' + id,
                    success: function (response) {
                        verJornadas();
                    },
                    error: function (response) {
                        verJornadas();
                    }
                })

                swal("La jornada fue eliminado.", {
                    icon: "success",
                });
            } else {
                swal("Accion cancelada");
                buttons: ["Aceptar"];
            }
        });


}

function verDepa2(){
    $.ajax({
        type:"GET",
        dataType:'json',
        url:"depas",
        success:function (response) {
            var rows="";
            console.log(response);
            $.each(response,function (key,value) {
                rows += `<option value="${value.id_departamento}">${value.departamento}</option>`
            });
            $('#depas2').html(rows);
        }
    })
}

function verTipoJornada2(){
    $.ajax({
        type:"GET",
        dataType:'json',
        url:"vertipos",
        success:function (response) {
            var rows="";
            $.each(response,function (key,value) {
                rows+= `<option value="${value.id_jornada}">${value.tipo_jornada}</option>`
            });
            $('#tipojornada2').html(rows);
        }
    })
}
