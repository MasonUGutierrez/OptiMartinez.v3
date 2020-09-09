$(function () {
    viewData();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function viewData() {

    $.ajax({
        type: "GET",
        dataType: "json",
        url: "planpagos",
        success: function (response) {
            var rows = "";
            $.each(response, function (key, value) {
                rows += `
                                <div class="col-sm-3">
                                   <!-- <div class="card bg-primary text-white mb-3" style="max-width: 18rem;">
                                        <div class="card-header">${value.plan_pago}</div>
                                        <div class="card-body">
                                            <p class="card-text">${value.descripcion}</p>
                                         </div>
                                        <div class="card-footer " style="text-align: center">
                                             <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <a href="planpago/${value.id_plan_pago}/edit"  data-target=".modal2" data-toggle="modal" onclick='editData(${value.id_plan_pago})' class="btn btn-raised btn-info waves-effect">
                                                 <i class="ti-pencil-alt"></i>
                                                </a>
                                             </span>
                                             <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Dar de Baja">
                                                 <a href="#"
                                                       class="btn btn-raised btn-danger waves-effect"
                                                       data-type="confirm"
                                                       data-title="Dar de Baja"
                                                       data-text="¿Desea eliminar el Plan de Pago: ${value.plan_pago} ?"
                                                       data-obj="${value.plan_pago}"
                                                       onclick="deleteData(${value.id_plan_pago})">
                                                         <i class="ti-trash"></i>
                                                </a>
                                             </span>
                                        </div>
                                    </div>-->
                                     <div class="card mcard_4 waves-effect  waves-float" >
                                        <div class="body" style="background: #ffffff">
                                            <div class="user">
                                                <h5 class="mt-3 mb-1">${value.plan_pago}</h5>
                                                <small class="text-muted">${value.descripcion}</small>
                                            </div>
                                            <ul class="list-unstyled social-links" >
                                                  <li ><span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Editar">
                                                    <a href="planpago/${value.id_plan_pago}/edit"  data-target=".modal2" data-toggle="modal" onclick='editData(${value.id_plan_pago})' >
                                                      <i class="zmdi zmdi-search"></i>
                                                    </a>
                                                 </span></li>
                                                 <li style="display: inline"><span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Dar de Baja">
                                                     <a href="#"
                                                           data-type="confirm"
                                                           data-title="Dar de Baja"
                                                           data-text="¿Desea eliminar el Plan de Pago: ${value.plan_pago} ?"
                                                           data-obj="${value.plan_pago}"
                                                           onclick="deleteData(${value.id_plan_pago})">
                                                              <i class="zmdi zmdi-delete"></i>
                                                    </a>
                                                 </span></li>
                                        </ul>
                                        </div>

                                    </div>
                                </div>
                            `;
            });
            $('#aqui').html(rows);
        }
    })
}

function saveData() {
    var plan_pago = $('#plan_pago').val();
    var descripcion = $('#descripcion').val();
    var data = {plan_pago: plan_pago, descripcion: descripcion};
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: data,
        url: 'planpago',
        success: function (result) {
            viewData();
            clearData();
        },
        error: function (result) {
        }
    })
}

function editData(id_plan_pago) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: "planpago/" + id_plan_pago + "/edit",
        success: function (response) {
            $("#plan_pago2").val(response[0].plan_pago);
            $("#descripcion2").val(response[0].descripcion);
            $("#idPlan").val(response[0].id_plan_pago);
        },
        error: function (result) {
            alert(result);
        }
    })
}

function updateData() {
    var plan_pago = $('#plan_pago2').val();
    var descripcion = $('#descripcion2').val();
    var data = {plan_pago: plan_pago, descripcion: descripcion, _method: $('input[name=_method]').val()};
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: data,
        url: 'planpago/' + $("#idPlan").val(),
        success: function (result) {
            viewData();
        },
        error: function (result) {
            viewData();

        }
    })
}

function deleteData(id) {

    swal({
        title: "¿Esta seguro que eliminar este plan de pago?",
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
                    url: 'planpago/' + id,
                    success: function (response) {
                        viewData();
                    },
                    error: function (response) {
                        viewData();
                    }
                })

                swal("El plan de pago fue eliminado.", {
                    icon: "success",
                });
            } else {
                swal("Accion cancelada");
                buttons: ["Aceptar"];
            }
        });


}


function clearData() {
    $('#plan_pago').val('');
    $('#descripcion').val('');
}
