$(function () {
    showData();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function showData() {
    $.ajax({
        type: "GET",
        dataType: "json",
        /*Poner el URL de la funcion que tiene el getAll que devuelve los datos*/
        url: "roless",
        success: function (response) {
            var rows = "";
            $.each(response, function (key, value) {
                rows += `
                                <tr>
                                    <td>${value.id_rol}</td>
                                    <td style="">${value.rol}</td>
                                    <td style="text-align: center">
                                        <a href="roles/${value.id_rol}" data-toggle="modal" data-target="#largeModal" onclick="showUserRol(${value.id_rol})"><button class="btn btn-secondary">Detalles</button></a>
                                        <a href="roles/${value.id_rol}/asignar"><button class="btn btn-info">Asignar a Usuario</button></a>
                                     <!--   <a href="roles/${value.id_rol}/asignar" data-toggle="modal" data-target=".assign-modal" onclick="assignRol(${value.id_rol})"><button class="btn btn-info">Asignar a Usuario</button></a> -->
                                    </td>
                                </tr>
                            `;
            });
            $('#tabla').html(rows);
        },
        error:function (response) {
            console.log(response);
        }
    })
}
function showUserRol(id) {
    $.ajax({
        type: "GET",
        dataType: "json",
        /*Poner el URL de la funcion que tiene el getAll que devuelve los datos*/
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
        error:function (responses) {
            console.log(responses);
        }
    })
}

/*function assignRol(id) {
    $.ajax({
        type: "GET",
        dataType: "json",
        /!*Poner el URL de la funcion que tiene el getAll que devuelve los datos*!/
        url: "roles/"+id+'/asignar',
        success: function (response) {
            var rows = "";
            $.each(response, function (key, value) {
                rows += `
                               <option value="${value.id_usuario}">${value.nombre} ${value.apellido} </option>
                            `;
            });
            $('#select').html(rows);
        },
        error:function (responses) {
            console.log(responses);
        }
    })
}*/
