$(function () {
    showData();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function showData() {
   /* $.ajax({
        type: "GET",
        dataType: "json",
        /!*Poner el URL de la funcion que tiene el getAll que devuelve los datos*!/
        url: "servicio",
        success: function (response) {
            var rows = "";
            $.each(response, function (key, value) {
                rows += `
                               <tr>
                                    <td>${value.servicio}</td>
                                    <td>${value.precio}</td>
                                    <td>
                                        <!-- Mejor forma de poner los tooltips -->
                                        <!--<span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Ver Detalles">
                                        <a href="" class="btn btn-raised btn-secondary waves-effect"><i class="ti-search"></i></a>
                                    </span>-->

                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <a href="servicios/${value.id_servicio}/edit" data-target=".servicioAsignar" data-toggle="modal"  onclick="editData(${value.id_servicio})" class="btn btn-raised btn-info waves-effect"><i class="ti-pencil-alt"></i></a>
                                        </span>
                                        <!-- Usando SweetAlert -->
                                        <span class=" d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Dar de Baja">
                                        <a href="#" class="btn btn-raised btn-danger waves-effect"
                                           data-type="confirm"
                                           data-title="Dar de Baja"
                                           data-text="¿Estas seguro en eliminar el servicio: ${value.servicio} ?"
                                           data-obj="${value.servicio}"
                                           onclick="deleteData(${value.id_servicio})">
                                            <i class="ti-trash"></i>
                                        </a>
                                        </span>
                                    </td>
                                </tr>
                            `;
            });
            $('tbody').html(rows);
        },
        error:function (response) {
            console.log(response);
        }
    })*/
    $('.dataTable-servicio').DataTable({
        destroy:true,
        processing:true,
        serverSide:true,
        ajax: {
            url:'servicio',
            type:'GET'
            // dataSrc: ''
        },
        columns:[
            {data:'servicio'},
            {data:'precio'},
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

function saveData() {
    var servicio = $('#servicio2').val();
    var precio = $('#precio2').val();
    var data = {servicio: servicio, precio: precio};

    $.ajax({
        type: 'post',
        dataType: 'json',
        data: data,
        url: 'servicios',
        success: function (result) {
        },
        error: function (result) {
            clearData();
            showData();
        }
    })
}

function clearData(){
    $('#servicio2').val("");
    $('#precio2').val("");
}

function editData(id_servicio) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: "servicios/"+id_servicio +"/edit",
        success: function (response) {
            $("#servicio").val(response[0].servicio);
            $("#precio").val(response[0].precio);
            $("#idServicio").val(response[0].id_servicio);
        },
        error: function (result) {
            alert(result);
        }
    })
}

function updateData() {
    var servicio = $('#servicio').val();
    var precio = $('#precio').val();
    var data = {servicio: servicio, precio: precio, _method: $('input[name=_method]').val()};
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: data,
        url: 'servicios/'+$("#idServicio").val(),
        success: function (result) {
            showData();
        },
        error: function (result) {
            showData();

        }
    })
}

function deleteData(id) {

    swal({
        title: "¿Esta seguro que eliminar este Servicio?",
        text: "Una vez eliminado no será capaz de recuperarlo!",
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
                    url: 'servicios/' + id,
                    success: function (response) {
                        showData();
                    },
                    error: function (response) {
                        showData();
                    }
                })

                swal("El Servicio fue eliminado.", {
                    icon: "success",
                });
            } else {
                swal("Accion cancelada");
                buttons: ["Aceptar"];
            }
        });


}
