
//Cada vez que en el select de pacientes cambie, los campos se actualizaran tambien

$('#nombrePacientes').on('change', function (){
    //Aqui se obtiene el id del paciente del select
    var id = $('#nombrePacientes').val();


    $('#nombre').val(" ");
    $('#apellidoPaciente').val(" ");
    $('#identificacion').val(" ");
    $('#edadPaciente').val(" ");

    //peticion ajax para traer todos los datos de un paciente mediante el id
    $.ajax({
        type:"GET",
        url:"pacienteById/" +id,
        success:function (pacientes){
           $('#nombre').val(pacientes[0].nombres);
           $('#apellidoPaciente').val(pacientes[0].apellidos);
           $('#identificacion').val(pacientes[0].cedula);
           $('#edadPaciente').val(pacientes[0].edad);
        }
    })


    $.ajax({
        type:"GET",
        url:"getHistoria/"+id,
        success:function (historiaC){
            $('#idHistoriaCuenta').val(historiaC[0].id_historia_cuenta);
            console.log("Valor del input Hidden: " + $('#idHistoriaCuenta').val());
        },error:function (result) {
           console.log("malo");
            console.log(result);
        }
    })
    console.log("id paciente al seleccionarse:"+id);




})
//Ajax para rellenar el select de Marcos cada que haya cambios en el select de marca
$('#marca').on('change',function (){
    $('#fotoMarco').attr('src', "");
    $('#marco option:selected').remove();
    $('#marco').trigger('change');
    $.ajax({
        type:"GET",
        url:"getMarcos/" + $('#marca').val(),
        success:function (marcos){
            var rows="<option class='text-muted' selected>-- Seleccione un Marco --</option>";
            $.each(marcos,function (key,value) {
                rows += `<option value="${value.id_marco}">${value.cod_marco} </option>`
            });
            $('#marco').html(rows);
        }
    })
})

//Funcion para la fecha de la consulta
function fecha(){
    //Traer la historia clinica
    $.ajax({
        type:"GET",
        url:"getHClinica/"+ $('#nombrePacientes').val(),
        success:function (values){
            $('#historiaClinica').val(values.id_historia_clinica);
            console.log("La historia clinica es:"+$('#historiaClinica').val());
            //Traer la fecha de la consulta
            $.ajax({
                type:"GET",
                url:"getFecha/"+ $('#historiaClinica').val(),
                success:function (values){
                    console.log("Consulta:");
                    console.log(values);
                    $('#fecha').val(values.fecha);
                },error:function (values){
                    console.log(values);
                }
            })
        },error:function (values){
            console.log(values);
        }
    })

}


//Ajax para la imagen del marco
$('#marco').on('change',function (){
    $('#fotoMarco').attr('src', "");
    $.ajax({
        type:"GET",
        url:"getMarcosInfo/" + $('#marco').val(),
        success:function (marcos){
            var dir = "/storage/imagenes/marcos/" + marcos[0].dir_foto ;
            $('#fotoMarco').attr('src', dir);
        }
    })
})

//Ajax para traer los planes de pago en el select del modal
$.ajax({
    type:"GET",
    url:"getPlanPagos",
    success:function (values){
        var rows="";
        $.each(values,function (key,value) {
            rows += `<option value="${value.id_plan_pago}">${value.plan_pago} </option>`
        });
        $('#getPlanPagos').html(rows);

    }
})



$(function (){
    //Ajax para rellenar el select con los pacientes

        $.ajax({
            type:"GET",
            url:"allPacientes",
            success:function (pacientes){
                var rows="<option class='text-muted' selected>-- Seleccione un Paciente --</option>";
                $.each(pacientes,function (key,value) {
                    rows += `<option value="${value.id_paciente}">${value.cedula} - ${value.nombres} ${value.apellidos} </option>`
                });
                $('#nombrePacientes').html(rows);
            }
        })

    //Ajax para rellenar el select de marcas
        $.ajax({
            type:"GET",
            url:"getMarcas",
            success:function (marcas){
                var rows="<option class='text-muted' selected>-- Seleccione una Marca --</option>";
                $.each(marcas,function (key,value) {
                    rows += `<option value="${value.id_marca}">${value.marca}</option>`
                });
                $('#marca').html(rows);
            }
        })

    //Ajax para rellenar select de Tipo lente
    $.ajax({
        type:"GET",
        url:"getLente",
        success:function (lente){
            var rows="<option class='text-muted' selected>-- Seleccione un Tipo de Lente --</option>";
            $.each(lente,function (key,value) {
                rows += `<option value="${value.id_tipo_lente}">${value.tipo_lente}</option>`
            });
            $('#tipoLente').html(rows);
        }
    })


    //Ajax para rellenar select de Tipo material
    $.ajax({
        type:"GET",
        url:"getMicas",
        success:function (micas){

            var rows="<option class='text-muted' selected>-- Seleccione un Tipo de Material --</option>";
            $.each(micas,function (key,value) {
                console.log(value.id_mica_marca);
                rows += `<option value="${value.id_mica_marca}">${value.marca_mica} - ${value.mica}</option>`
            });
            $('#tipoMaterial').html(rows);
        }
    })


    //Ajax para rellenar select Filtro
    //Ajax para rellenar select Marca de Material
    $.ajax({
        type:"GET",
        url:"getFiltro",
        success:function (filtros){
            var rows="<option class='text-muted' selected>-- Seleccione una Material --</option>";
            $.each(filtros,function (key,value) {
                rows += `<option value="${value.id_filtro}">${value.filtro}</option>`
            });
            $('#filtro').html(rows);
        }
    })
})


