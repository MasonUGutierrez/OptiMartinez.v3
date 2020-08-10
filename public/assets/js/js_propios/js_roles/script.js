$(function () {
    showData();
});

var rolesId="";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function showData() {
    $('.dataTable-rol').DataTable({
        destroy:true,
        processing:true,
        serverSide:true,
        ajax: {
            url:'roless',
            type:'GET'
            // dataSrc: ''
        },
        columns:[
            {data:'id_rol'},
            {data:'rol'},
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
function showUserRol(id) {

    console.log(id);
    $('.dataTable-usuarios').DataTable({
        destroy:true,
        processing:true,
        serverSide:true,
        ajax: {
            url:'roles/'+id,
            type:'GET'
            // dataSrc: ''
        },
        columns:[
            {data:'NombreCompleto'},
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
  /*  $.ajax({
        type: "GET",
        dataType: "json",
        /!*Poner el URL de la funcion que tiene el getAll que devuelve los datos*!/
        url: "roles/"+id,
        success: function (response) {
            var rows = "";
            $.each(response, function (key, value) {
                rows += `
                                <tr>
                                        <td style="text-align: center">${value.nombre} ${value.apellido}</td>
                                        <td ><a href="usuarios/${value.id_usuario}/edit"><button class="btn btn-info">Editar</button></a></td>
                                </tr>
                            `;
            });
            $('#tablamodal').html(rows);
        },
        error:function (response) {
            console.log(response);
        }
    })*/
}

function assignRol(id) {
    $idrol = id;
    rolesId = id;
    $.ajax({
        type: "GET",
        dataType: "json",
        /*Poner el URL de la funcion que tiene el getAll que devuelve los datos*/
        url: "roles/"+$idrol+'/asignar',
        success: function (response) {
            var rows = "";
            $.each(response, function (key, value) {

                rows += `
                               <option value="${value.id_usuario}">${value.nombre} ${value.apellido} </option>
                            `;
            });
            $('#select').html(rows);
        },
        error:function (response) {
            console.log("error");
        }
    })
}

function saveAssign(){
    var seleccion = $('#select').val();
    var data = {id_usuario:seleccion,id_rol:rolesId};
    $.ajax({
        type:'post',
        dataType: 'json',
        data:data,
        url:'roles',
        success: function (result) {
            clearData();
        },error:function (result) {
            clearData();
        }
    })
}

function clearData(){
    $('#select').val(null).trigger('change');
}
