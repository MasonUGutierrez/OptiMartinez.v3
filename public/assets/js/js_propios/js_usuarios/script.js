/*
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
*/

function editUsuario(){
    $('#cod_minsa').removeAttr("disabled","disabled");
    $('#nombreUsuario').removeAttr("disabled","disabled");
    $('#apellidoUsuario').removeAttr("disabled","disabled");
    $('#cedulaUsuario').removeAttr("disabled","disabled");
    $('#telefonoUsuario').removeAttr("disabled","disabled");
    $('#emailUsuario').removeAttr("disabled","disabled");
    $('#descripcionUsuario').removeAttr("disabled","disabled");
    $('#rolesUsuario').removeAttr("disabled","disabled");
    $('#botonEditar').attr('hidden','hidden');
    $('#botonCancelar').removeAttr('hidden','hidden');
    $('#pass').removeAttr('hidden','hidden');
    $('#passReco').removeAttr('hidden','hidden');
    $('#botonGuardar').removeAttr('hidden','hidden');

}

function cancelUsuario(){
    $('#cod_minsa').attr("disabled","disabled");
    $('#nombreUsuario').attr("disabled","disabled");
    $('#apellidoUsuario').attr("disabled","disabled");
    $('#cedulaUsuario').attr("disabled","disabled");
    $('#telefonoUsuario').attr("disabled","disabled");
    $('#emailUsuario').attr("disabled","disabled");
    $('#descripcionUsuario').attr("disabled","disabled");
    $('#rolesUsuario').attr("disabled","disabled");
    $('#botonEditar').removeAttr('hidden','hidden');
    $('#botonCancelar').attr('hidden','hidden');
    $('#pass').attr('hidden','hidden');
    $('#passReco').attr('hidden','hidden');
    $('#botonGuardar').attr('hidden','hidden');
}

/*function updateUsuario(){

    var cod = $('#cod_minsa').val();
    var nombre = $('#nombreUsuario').val();
    var apellido = $('#apellidoUsuario').val();
    var cedula = $('#cedulaUsuario').val();
    var telefono = $('#telefonoUsuario').val();
    var email = $('#emailUsuario').val();
    var descripcion = $('#descripcionUsuario').val();
    var roles = $('#rolesUsuario').val();
    var contra = $('#pass').val();

    var data = {cod_minsa:cod,nombre:nombre,apellido:apellido,cedula:cedula,
                telefono:telefono,correo:email,descripcion:descripcion,
                id_rol:roles,contraseña:contra,_method: $('input[name=_method]').val()}
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: data,
        url:'/usuarios/' + $('#idUsuario').val(),
        succes: function (result){
            console.log(result);
        },error:function (result){
            console.log(result);
        }
    })
}*/
