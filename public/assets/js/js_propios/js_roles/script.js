$(function () {
    viewData();
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
        url: "roles",
        success: function (response) {
            var rows = "";
            console.log(response);
            $.each(response, function (key, value) {
                rows += `
                                <tr>
                                    <td>${value.id_rol}</td>
                                    <td style="">${value.rol}</td>
                                    <td style="text-align: center">
                                        <!--<a href="{{URL::action('OpticaControllers\\RolController@show',$cat->id_rol)}}"><button class="btn btn-secondary">Detalles</button></a>-->
                                        <a href="" data-target="#modal-asignar-{{$cat->id_rol}}" data-toggle="modal">
                                            <button class="btn btn-info">Asignar a Usuario</button>
                                        </a>
                                        <a href="{{URL::action('OpticaControllers\\RolController@asignar',$cat->id_rol)}}" ><button class="btn btn-info">Asignar a Usuario</button></a>
                                    </td>
                                </tr>
                            `;
            });
            $('tbody').html(rows);
        }
    })
}
