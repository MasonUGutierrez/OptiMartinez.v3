$(function () {
    showData();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function showData() {
    alert("Entro en el showData");
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "roles",
        success: function (response) {
            console.log(response);
            var rows = "";
            $.each(response, function (key, value) {
                rows += `
                                <tr>
                                    <td>${value.id_rol}</td>
                                    <td style="">${value.rol}</td>
                                    <td style="text-align: center">
                                        <a href="roles/${value.id_rol}"><button class="btn btn-secondary">Detalles</button></a>
                                        <a href="roles/${value.id_rol}/asignar" ><button class="btn btn-info">Asignar a Usuario</button></a>
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
